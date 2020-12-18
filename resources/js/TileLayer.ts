import * as L from 'leaflet';

export default class TileLayer {

    /**
     * @protected themes : Array
     */
    protected themes : Array<any>;

    /**
     * @param leaf : L.Map
     * @param tile : <any>
     */
    constructor(protected leaf : L.Map, protected tile : any) {
        //
    }

    /**
     * @return string|boolean
     */
    public getTheme() : string | boolean {
        return this.tile.theme;
    }

    /**
     * @return boolean
     */
    public isEnabled() : boolean {
        return this.getTheme() !== null && this.getTheme() !== '' && this.getTheme() !== false;
    }

    /**
     * @return boolean
     */
    public hasTheme(theme : string) : boolean {
        return this.tile.theme === theme;
    }

    /**
     * @return boolean
     */
    public withLabel() : boolean {
        return this.tile.label;
    }

    /**
     * @return object
     */
    private static getOptions() : object {
        return {
            // TODO : Options for TileLayer
        };
    }

    /**
     * @return void
     */
    public drawBackground() : L.TileLayer {
        // @ts-ignore
        return new L.tileLayer(this.getTileURL(), TileLayer.getOptions()).addTo(this.leaf);
    }

    /**
     * @return string|null;
     */
    private getTileURL() : string | null {
        if (this.hasTheme('positron')) {
            if (this.withLabel()) {
                return 'https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png';
            }

            return 'https://{s}.basemaps.cartocdn.com/rastertiles/light_nolabels/{z}/{x}/{y}.png';
        }

        if (this.hasTheme('voyager')) {
            if (this.withLabel()) {
                return 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}.png';
            }

            return 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_nolabels/{z}/{x}/{y}.png';
        }

        if (this.hasTheme('matter')) {
            if (this.withLabel()) {
                return 'https://{s}.basemaps.cartocdn.com/rastertiles/dark_all/{z}/{x}/{y}.png';
            }

            return 'https://{s}.basemaps.cartocdn.com/rastertiles/dark_nolabels/{z}/{x}/{y}.png';
        }

        return 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}.png';
    }
}