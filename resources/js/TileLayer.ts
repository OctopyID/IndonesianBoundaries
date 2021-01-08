import { TileLayer as BaseTileLayer } from "leaflet";
import Collection from "./Collection";
import Helper from "./Helper";

export default class TileLayer extends BaseTileLayer
{
    /**
     * @param config Collection<any>
     */
    constructor(protected config : Collection<any>) {
        super('', config.get('options').reverse());
    }

    /**
     * @return boolean
     */
    public enabled() : boolean {
        return typeof this.config.get('theme') !== 'boolean' || this.config.get('theme') !== null || this.config.get('theme') !== '';
    }

    /**
     * @param theme string|null
     * @param label boolean|null
     */
    public theme(theme : string | null = null, label : boolean | null = null) {

        if (theme === null) {
            theme = this.config.get('theme');
        }

        if (label === null) {
            label = this.config.get('label');
        }

        if (! Helper.isURI(theme)) {
            theme = TileLayer.presetTheme(theme, label);
        }

        return this.setUrl(theme);
    }

    /**
     * @param  theme string
     * @param  label boolean
     * @return string
     */
    private static presetTheme(theme : string, label : boolean) : string {
        switch (theme) {
            case 'positron':
                if (label) {
                    return 'https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png';
                }

                return 'https://{s}.basemaps.cartocdn.com/rastertiles/light_nolabels/{z}/{x}/{y}.png';
            case 'voyager':
                if (label) {
                    return 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}.png';
                }

                return 'https://{s}.basemaps.cartocdn.com/rastertiles/light_nolabels/{z}/{x}/{y}.png';
            case 'matter':
                if (label) {
                    return 'https://{s}.basemaps.cartocdn.com/rastertiles/dark_all/{z}/{x}/{y}.png';
                }

                return 'https://{s}.basemaps.cartocdn.com/rastertiles/dark_nolabels/{z}/{x}/{y}.png'
        }
    }
}