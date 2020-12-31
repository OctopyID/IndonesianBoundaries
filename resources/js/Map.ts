import { Map as LeafletMap } from 'leaflet';
import "reflect-metadata";
import { container } from "tsyringe";
import Collection from "./Collection";
import Config from "./Config";
import GeoJSON from "./GeoJSON";
import TileLayer from "./TileLayer";

export default class Map {

    protected conf : Config;

    protected tiles : Object;

    protected layers : Collection;

    protected instance : LeafletMap;

    constructor(config : Config) {
        this.conf = config;
        this.tiles = {};
    }

    public render() {
        this.instance = new LeafletMap(
            this.conf.getRootElement(), this.conf.getMapOptions()
        );

        if (this.tileLayer().enabled()) {
            this.tileLayer().render();
        }

        this.layers = this.assignMapRegion().map((region : GeoJSON) => {
            return region.render(this);
        });

        return this;
    }

    public provinces(callback : CallableFunction | null = null) {
        if (callback) {
            return this.regions().get('prov').map(row => row.then(layer => {
                return callback(layer);
            }));
        }

        return this.regions().get('prov');
    }

    public cities(callback : CallableFunction | null = null) {
        if (callback) {
            return this.regions().get('city').map(row => row.then(layer => {
                return callback(layer);
            }));
        }

        return this.regions().get('city');
    }

    public districts(callback : CallableFunction | null = null) {
        if (callback) {
            return this.regions().get('dist').map(row => row.then(layer => {
                return callback(layer);
            }));
        }

        return this.regions().get('dist');
    }

    public villages(callback : CallableFunction | null = null) {
        if (callback) {
            return this.regions().get('vill').map(row => row.then(layer => {
                return callback(layer);
            }));
        }

        return this.regions().get('vill');
    }

    public regions(callback : CallableFunction | null = null) : any {
        if (callback) {
            return this.layers.map(element => {
                return element.map(region => region.then(layer => {
                    return callback(layer);
                }))
            });
        }

        return this.layers;
    }

    public leaflet() : LeafletMap {
        return this.instance;
    }

    public tileLayer() {
        container.clearInstances();

        container.register('map', {
            useValue: this
        });

        let name = this.conf.getRootElement();
        if (this.tiles.hasOwnProperty(name)) {
            return this.tiles[name];
        }

        return this.tiles[name] = container.resolve(TileLayer);
    }

    public config(key : string | null = null, value : any = null) {
        return this.conf.config(key, value);
    }

    public hasElement(root : string) : boolean {
        return this.conf.getRootElement() === root;
    }

    private assignMapRegion() {
        return this.config('data').map(item => {
            return new GeoJSON(item);
        });
    }
}