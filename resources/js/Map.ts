import { Map as BaseMap } from "leaflet";
import Collection from "./Collection";
import Helper from "./Helper";
import Region from "./Region";
import TileLayer from "./TileLayer";

export default class Map extends BaseMap
{
    /**
     * @var tileLayer TileLayer
     */
    private tileLayer : TileLayer;

    /**
     * @private Collection
     */
    private _regions : Collection<any>;

    /**
     * @param containerID string
     * @param config Collection
     */
    constructor(protected containerID : string, protected config : Collection<any>) {
        super(containerID, config.get('options').reverse());

        this.register();
    }

    /**
     * @return void
     */
    private register() : void {
        // TileLayer
        this.tileLayer = new TileLayer(
            this.config.get('tilelayer')
        ).addTo(this);

        // Render TileLayer when enabled
        if (this.tileLayer.enabled()) {
            this.tileLayer.theme();
        }

        // Set Attribution
        this.attribution('<a href="https://github.com/OctopyID/IndonesianBoundaries">OctopyID - Indonesian Boundary</a>');
    }

    /**
     * @param  attribution string|Array<string>
     * @return Map
     */
    public attribution(attribution : string | Array<string>) : Map {
        if (attribution instanceof Array) {
            attribution = attribution.join(' | ');
        }

        this.attributionControl.addAttribution(attribution);

        let text = this.getContainer().getElementsByClassName('leaflet-control-attribution');

        text[0].innerHTML = text[0].innerHTML.replace(',', ' |');

        return this;
    }

    /**
     * @param  fn CallableFunction
     * @return Collection<any>
     */
    public regions(fn : CallableFunction = null) : Collection<any> {
        if (fn) {
            this._regions.each(regions => {
                regions.each(promise => promise.then(region => {
                    fn(region);
                }))
            });
        }

        return this._regions;
    }

    /**
     * @param  fn CallableFunction
     * @return Collection<any>
     */
    public provinces(fn : CallableFunction = null) : Collection<any> {
        let provinces = this._regions.filter((regions, type) => type === 'provinces');

        if (fn) {
            provinces.each(regions => {
                regions.each(promise => promise.then(region => {
                    fn(region);
                }));
            });
        }

        return provinces;
    }

    /**
     * @param  fn CallableFunction
     * @return Collection<any>
     */
    public cities(fn : CallableFunction = null) : Collection<any> {
        let cities = this._regions.filter((regions, type) => type === 'cities');

        if (fn) {
            cities.each(regions => {
                regions.each(promise => promise.then(region => {
                    fn(region);
                }));
            });
        }

        return cities;
    }

    /**
     * @param  fn CallableFunction
     * @return Collection<any>
     */
    public districts(fn : CallableFunction = null) : Collection<any> {
        let districts = this._regions.filter((regions, type) => type === 'districts');

        if (fn) {
            districts.each(regions => {
                regions.each(promise => promise.then(region => {
                    fn(region);
                }));
            });
        }

        return districts;
    }

    /**
     * @param  fn CallableFunction
     * @return Collection<any>
     */
    public villages(fn : CallableFunction = null) : Collection<any> {
        let villages = this._regions.filter((regions, type) => type === 'villages');

        if (fn) {
            villages.each(regions => {
                regions.each(promise => promise.then(region => {
                    fn(region);
                }));
            });
        }

        return villages;
    }

    /**
     * @return Map
     */
    public render() : Map {
        this._regions = this.config.get('data').map((item : Collection<any>, type : string) => {
            return item.get('regions').map(async region => {
                return await Helper.fetchGeometry(region).then(json => {
                    if (json.message !== undefined) {
                        console.log(json.message);
                    } else {
                        return new Region({
                                type: 'Feature' as const,
                                geometry: json.geometry,
                                properties: json.properties,
                            },
                            type, region.get('meta').reverse(), item, this
                        ).addTo(this);
                    }
                });
            });
        });

        return this;
    }
}