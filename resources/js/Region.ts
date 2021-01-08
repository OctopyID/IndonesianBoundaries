import { GeoJSON, LatLng } from "leaflet";
import Collection from "./Collection";
import Helper from "./Helper";
import LayerStyle from "./LayerStyle";
import Marker from "./Marker";
import Map from "./Map";

export default class Region extends GeoJSON
{
    /**
     * @private Marker
     */
    private _marker : Marker;

    /**
     * @private LayerStyle
     */
    private _style : LayerStyle;

    /**
     * @private Promise<Collection<Promise<Region>>>;
     */
    private _cities : Promise<Collection<Promise<Region>>>;

    /**
     * @private Promise<Collection<Promise<Region>>>;
     */
    private _districts : Promise<Collection<Promise<Region>>>;

    /**
     * @private Promise<Collection<Promise<Region>>>;
     */
    private _villages : Promise<Collection<Promise<Region>>>;

    /**
     * @param feature object
     * @param type    string
     * @param meta    object
     * @param _config Collection
     * @param map
     */
    public constructor(feature, protected type : string, protected meta : any, public _config : Collection<any>, protected map : Map) {
        super(feature, {
            style: _config.get('style').reverse(),
        });
    }

    /**
     * @return number
     */
    public getCode() : number {
        return this.getProperties().code;
    }

    /**
     * @return string
     */
    public getName() : string {
        return this.getProperties().name;
    }

    /**
     * @param  id number|null
     * @return { code : number, name : string }
     */
    public getProperties(id : number | null = null) : { code : number, name : string } {
        return this.getFeature(id).properties;
    }

    /**
     * @return LatLng
     */
    public getCenter() : LatLng {
        if (this.meta.lat.length !== 0 || this.meta.lng.length) {
            return new LatLng(this.meta.lat, this.meta.lng);
        }

        return this.getBounds().getCenter();
    }

    /**
     * @param  id number|null
     * @return { type : string, geometry : any, properties : any }
     */
    public getFeature(id : number | null = null) : { type : string, geometry : any, properties : any } {
        return this.getLayer(id).feature;
    }

    /**
     * @param  id number
     * @return any
     */
    public getLayer(id : number = null) : any {
        if (id) {
            return super.getLayer(id);
        }

        return super.getLayers()[0];
    }

    /**
     * @param  fn CallableFunction
     * @return LayerStyle
     */
    public style(fn : CallableFunction) : LayerStyle {
        if (! this._style) {
            this._style = new LayerStyle(this);
        }

        if (fn) {
            fn(this._style);
        }

        return this._style;
    }

    /**
     * @param  fn CallableFunction
     * @return Marker
     */
    public marker(fn : CallableFunction) : Marker {

        if (! this._marker) {
            this._marker = new Marker(this).addTo(this);
        }

        if (fn) {
            fn(this._marker);
        }

        return this._marker;
    }

    /**
     * @param  fn CallableFunction
     * @return Promise<any>
     */
    public getCities(fn : CallableFunction | null = null) : Promise<any> {
        if (this.type !== 'provinces') {
            console.log(`To get cities data, your layer must be of type province, given ${ this.type }.`);
        } else {
            let promise = Helper.fetchCities(this.getCode());

            if (fn) {
                promise.then(collection => fn(collection));
            }

            return promise;
        }
    }

    /**
     * @param  fn CallableFunction
     * @return Promise<Collection<Promise<Region>>>
     */
    public renderCities(fn : CallableFunction | null = null) : Promise<Collection<Promise<Region>>> {
        this.removeCities();
        if (this.type !== 'provinces') {
            console.log(`To render cities, your layer must be of type Province, given ${ this.type }.`);
        } else {
            return this._cities = this.getCities().then(collection => {
                return collection.map(city => {
                    let geometry = this.fetchGeometry(city, 'cities');
                    if (fn) {
                        geometry.then(region => fn(region));
                    }

                    return geometry;
                });
            });
        }
    }

    /**
     * @return void
     */
    public removeCities() {
        if (this._cities instanceof Promise) {
            this._cities.then(collection => collection.map(city => {
                this.map.removeLayer(city);
            }));

            this._cities = null;
        }
    }

    /**
     * @param  fn CallableFunction|null
     * @return Promise<Collection<Promise<Region>>>
     */
    public getDistricts(fn : CallableFunction | null = null) {
       if (this.type !== 'cities') {
            console.log(`To get districts data, your layer must be of type cities, given ${ this.type }.`);
        } else {
            let promise = Helper.fetchDistricts(this.getCode());

            if (fn) {
                promise.then(collection => fn(collection));
            }

            return promise;
        }
    }

    /**
     * @param  fn CallableFunction|null
     * @return Promise<Collection<Promise<Region>>>
     */
    public renderDistricts(fn : CallableFunction | null = null) : Promise<Collection<Promise<Region>>> {
        this.removeDistricts();
        if (this.type !== 'cities') {
            console.log(`To render districts, your layer must be of type cities, given ${ this.type }.`);
        } else {
            return this._districts = this.getDistricts().then(collection => {
                return collection.map(district => {
                    let geometry = this.fetchGeometry(district, 'districts');
                    if (fn) {
                        geometry.then(region => fn(region));
                    }

                    return geometry;
                });
            });
        }
    }

    /**
     * @return void
     */
    public removeDistricts() {
        if (this._districts instanceof Promise) {
            this._districts.then(collection => collection.map(city => {
                this.map.removeLayer(city);
            }));

            this._districts = null;
        }
    }

    /**
     * @param  fn CallableFunction|null
     * @return Promise<Collection<Promise<Region>>>
     */
    public getVillages(fn : CallableFunction | null = null) {
        if (this.type !== 'districts') {
            console.log(`To get village data, your layer must be of type districts, given ${ this.type }.`);
        } else {
            let promise = Helper.fetchVillages(this.getCode());

            if (fn) {
                promise.then(collection => fn(collection));
            }

            return promise;
        }
    }

    /**
     * @param  fn CallableFunction|null
     * @return Promise<Collection<Promise<Region>>>
     */
    public renderVillages(fn : CallableFunction | null = null) : Promise<Collection<Promise<Region>>> {
        this.removeVillages();
        if (this.type !== 'districts') {
            console.log(`To render villages, your layer must be of type districts, given ${ this.type }.`);
        } else {
            return this._villages = this.getVillages().then(collection => {
                return collection.map(district => {
                    let geometry = this.fetchGeometry(district, 'villages');
                    if (fn) {
                        geometry.then(region => fn(region));
                    }

                    return geometry;
                });
            });
        }
    }

    /**
     * @return void
     */
    public removeVillages() {
        if (this._villages instanceof Promise) {
            this._villages.then(collection => collection.map(city => {
                this.map.removeLayer(city);
            }));

            this._villages = null;
        }
    }

    /**
     * @param  region object
     * @param  type   string
     * @return Promise<Region>
     */
    private fetchGeometry(region, type : string) : Promise<Region> {
        return Helper.fetchGeometry(region.id).then(json => {
            if (json.message !== undefined) {
                console.log(json.message);
            } else {
                return new Region({
                        type: 'Feature' as const,
                        geometry: json.geometry,
                        properties: json.properties,
                    },
                    type, json.properties.meta, this._config, this.map
                ).addTo(this.map);
            }
        });
    }
}
