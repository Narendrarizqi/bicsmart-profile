import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

async function initVillageMap() {
    const mapElement = document.getElementById('village-map');
    const statusElement = document.getElementById('village-map-status');

    if (!mapElement || !statusElement) {
        return;
    }

    let leaflet;
    try {
        const [, leafletModule] = await Promise.all([
            import('leaflet/dist/leaflet.css'),
            import('leaflet'),
        ]);
        leaflet = leafletModule.default;
    } catch (error) {
        console.error('Gagal memuat pustaka peta:', error);
        statusElement.textContent = 'Peta desa gagal dimuat. Daftar desa di bawah tetap dapat digunakan.';
        return;
    }

    const map = leaflet.map(mapElement, {
        scrollWheelZoom: false,
        zoomControl: true,
    });

    const boundsStyle = {
        color: '#087f5b',
        weight: 2,
        opacity: 0.9,
        fillColor: '#34a982',
        fillOpacity: 0.22,
    };

    let activeVillage = null;
    let villageDataLoaded = false;
    let tilesUnavailable = false;
    const showStatus = (message) => {
        statusElement.textContent = message;
    };
    const showVillage = (name, district) => {
        activeVillage = name;
        showStatus(`${name} · Kecamatan ${district}`);
    };
    const showDefaultStatus = () => {
        activeVillage = null;
        showStatus(tilesUnavailable
            ? 'Peta dasar tidak dapat dimuat. Batas desa tetap tersedia; periksa koneksi internet.'
            : 'Arahkan kursor atau fokuskan batas desa untuk melihat namanya. Klik desa untuk memperbesar peta.');
    };

    const tiles = leaflet.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    tiles.on('tileerror', () => {
        tilesUnavailable = true;
        if (villageDataLoaded) {
            showDefaultStatus();
        } else {
            showStatus('Peta dasar tidak dapat dimuat. Batas desa sedang dimuat.');
        }
    });
    tiles.on('load', () => {
        tilesUnavailable = false;
        if (villageDataLoaded && !activeVillage) {
            showDefaultStatus();
        }
    });

    fetch(mapElement.dataset.geojsonUrl, {
        headers: { Accept: 'application/geo+json, application/json' },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Permintaan peta gagal (${response.status}).`);
            }

            return response.json();
        })
        .then((data) => {
            if (data.type !== 'FeatureCollection' || !Array.isArray(data.features) || data.features.length !== 12) {
                throw new Error('Data peta tidak berisi 12 wilayah desa yang diharapkan.');
            }

            const villages = leaflet.geoJSON(data, {
                style: () => ({ ...boundsStyle }),
                onEachFeature: (feature, layer) => {
                    const { name, district } = feature.properties ?? {};
                    if (!name || !district || !feature.geometry) {
                        throw new Error('Data batas desa tidak lengkap.');
                    }

                    const tooltip = document.createElement('span');
                    const villageName = document.createElement('strong');
                    const districtName = document.createElement('span');
                    villageName.textContent = name;
                    districtName.textContent = `Kecamatan ${district}`;
                    districtName.className = 'block text-xs text-slate-600';
                    tooltip.append(villageName, districtName);

                    layer.bindTooltip(tooltip, { sticky: true, direction: 'top', opacity: 1 });
                    layer.on('mouseover', () => {
                        layer.setStyle({ color: '#075e45', weight: 3, fillOpacity: 0.48 });
                        layer.openTooltip();
                        showVillage(name, district);
                    });
                    layer.on('mouseout', (event) => {
                        layer.setStyle(boundsStyle);
                        if (event.originalEvent?.relatedTarget !== layer.getElement()) {
                            layer.closeTooltip();
                        }
                        if (document.activeElement !== layer.getElement()) {
                            showDefaultStatus();
                        }
                    });
                    layer.on('click', () => {
                        map.fitBounds(layer.getBounds(), { maxZoom: 15, padding: [24, 24] });
                    });
                    layer.on('add', () => {
                        const path = layer.getElement();
                        if (!path) {
                            return;
                        }

                        path.setAttribute('tabindex', '0');
                        path.setAttribute('role', 'button');
                        path.setAttribute('aria-label', `${name}, Kecamatan ${district}. Tekan Enter untuk memperbesar peta.`);
                        path.addEventListener('focus', () => {
                            layer.setStyle({ color: '#075e45', weight: 3, fillOpacity: 0.48 });
                            layer.openTooltip();
                            showVillage(name, district);
                        });
                        path.addEventListener('blur', () => {
                            layer.setStyle(boundsStyle);
                            layer.closeTooltip();
                            showDefaultStatus();
                        });
                        path.addEventListener('keydown', (event) => {
                            if (event.key === 'Enter' || event.key === ' ') {
                                event.preventDefault();
                                map.fitBounds(layer.getBounds(), { maxZoom: 15, padding: [24, 24] });
                            }
                        });
                    });
                },
            }).addTo(map);

            map.fitBounds(villages.getBounds(), { padding: [24, 24] });
            villageDataLoaded = true;
            showDefaultStatus();
            window.setTimeout(() => map.invalidateSize(), 100);
        })
        .catch((error) => {
            console.error('Gagal memuat peta sebaran desa:', error);
            showStatus('Peta desa gagal dimuat. Daftar desa di bawah tetap dapat digunakan.');
        });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initVillageMap, { once: true });
} else {
    initVillageMap();
}
