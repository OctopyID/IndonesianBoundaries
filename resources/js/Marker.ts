import { DivIcon, Icon, Marker as BaseMarker } from "leaflet";
import Helper from "./Helper";
import Region from "./Region";

export default class Marker extends BaseMarker
{
    /**
     * @param region Region
     */
    constructor(protected region : Region) {
        super(region.getCenter(), region._config.get('marker.options').reverse());

        this.icon({
            //
        });
    }

    /**
     * @param options object|Icon|DivIcon
     */
    public icon(options : object | Icon | DivIcon) {

        if (! (options instanceof Icon) && ! (options instanceof DivIcon)) {
            if (! ("html" in options) && ! ("className" in options)) {
                options = new Icon({
                    ...this.defaultOptions(),
                    ...options
                });
            } else {
                options = new DivIcon({
                    ...this.defaultOptions(),
                    ...options
                });
            }
        }

        // @ts-ignore
        return this.setIcon(options);
    }

    /**
     * @param options   object|DivIcon
     * @param className string|null
     */
    public divIcon(options : string | object | DivIcon, className : string | null = null) {
        if (typeof options === 'string') {
            if (className) {
                options = {
                    html: options,
                    className: className,
                };
            } else {
                options = {
                    className: options
                };
            }
        }

        return this.icon(options);
    }

    /**
     * @param text      string
     * @param className string
     */
    public textIcon(text : string, className : string) {
        return this.divIcon(text, className);
    }

    /**
     * @return object
     */
    private defaultOptions() {
        let options = this.region._config.get('marker.icon').reverse();

        if (! Helper.isURI(options.iconUrl)) {
            options.iconUrl = Helper.getIcon(options.iconUrl);
        }

        if (! Helper.isURI(options.shadowUrl)) {
            options.shadowUrl = Helper.getIcon(options.shadowUrl);
        }

        return options;
    }
}