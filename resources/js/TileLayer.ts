import { TileLayer as LeafletTileLayer } from "leaflet";
import { inject, singleton } from "tsyringe";
import Map from "./Map";

/**
 * @method element(element : string)
 */
@singleton()
export default class TileLayer {
    private map : Map;

    private tile : LeafletTileLayer;

    constructor(@inject('map')map : Map) {
        this.map = map;
    }

    private static tileURL(theme : string | boolean, label : boolean = false) : string | null {
        if (theme === 'positron') {
            if (label) {
                return 'https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png';
            }

            return 'https://{s}.basemaps.cartocdn.com/rastertiles/light_nolabels/{z}/{x}/{y}.png';
        }

        if (theme === 'voyage') {
            if (label) {
                return 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}.png';
            }

            return 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_nolabels/{z}/{x}/{y}.png';
        }

        if (theme === 'matter') {
            if (label) {
                return 'https://{s}.basemaps.cartocdn.com/rastertiles/dark_all/{z}/{x}/{y}.png';
            }

            return 'https://{s}.basemaps.cartocdn.com/rastertiles/dark_nolabels/{z}/{x}/{y}.png';
        }

        return 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}.png';
    }

    public render() {
        this.tile = new LeafletTileLayer(TileLayer.tileURL(this.theme(), this.label()), {
            //
        }).addTo(this.map.leaflet());
    }

    public enabled() : boolean {
        return this.theme() !== false && this.theme() !== null && this.theme() !== '';
    }

    public theme(theme : string | boolean = null, label : boolean = false) : string | boolean | null {
        if (theme !== null) {
            this.tile.setUrl(TileLayer.tileURL(theme, label));
        }

        return this.map.config('background.theme', false);
    }

    public label() : boolean {
        return this.map.config('background.label');
    }
}