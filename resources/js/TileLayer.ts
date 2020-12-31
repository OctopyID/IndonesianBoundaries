import { TileLayer as LeafletTileLayer } from "leaflet";
import { inject, singleton } from "tsyringe";
import Map from "./Map";

/**
 * @method element(element : string)
 */
@singleton()
export default class TileLayer extends LeafletTileLayer {

    readonly NO_LABEL = false;

    readonly WITH_LABEL = true;

    protected map : Map;

    protected tile : LeafletTileLayer;

    constructor(@inject('map')map : Map) {
        super('', {
            //
        });

        this.map = map;
    }

    protected static tileURL(theme : string | boolean, label : boolean = false) : string | null {
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
        if (this.enabled()) {
            this.addTo(this.map.leaflet()).setTheme(this.getConfigTheme(), this.label());
        }
    }

    public enabled() : boolean {
        return this.getConfigTheme() !== false && this.getConfigTheme() !== null && this.getConfigTheme() !== '';
    }

    public setTheme(theme : string | boolean = null, label : boolean = false) : this {
        return this.setUrl(TileLayer.tileURL(theme, label));
    }

    public label() : boolean {
        return this.map.config('background.label');
    }

    protected getConfigTheme() : string | null | boolean {
        return this.map.config('background.theme', false);
    }

}