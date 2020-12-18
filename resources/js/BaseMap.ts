// @ts-ignore
import * as L from 'leaflet';
import TileLayer from './TileLayer';
import Region from './Region';

export default class BaseMap {

    /**
     * @protected
     */
    protected leaf : L.Map;

    /**
     * @param root : string
     * @param data : <any>
     */
    constructor(protected root : string, protected data : any) {
        //
    }

    /**
     * @return string
     */
    public getRootElement = () : string => this.root;

    /**
     * @return Object
     */
    public getRegion() {
        let array = [];
        Object.entries(this.data.data).forEach(([name, item]) => {
            array.push(new Region(name, item));
        })

        return Object.values(array);
    }

    /**
     * @return object
     */
    public getOptions() : object {
        return {
            center: [
                this.data.center.lat,
                this.data.center.lng,
            ],
            ...this.data.options,
        };
    }

    /**
     * @return TileLayer
     */
    public tileLayer() : TileLayer {
        return new TileLayer(this.leaf, this.data.background);
    }

    /**
     * @return L.Map
     */
    public drawBaseMap() : L.Map {
        return this.leaf = L.map(this.getRootElement(), this.getOptions());
    }

    /**
     * @return void
     */
    public addAttribution() : void {
        this.leaf.attributionControl.addAttribution(
            '<a href="https://www.octopy.id">Octopy ID</a> | <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        );

    }

    /**
     * @return L.Map
     */
    public getLeafletInstance() : L.Map {
        return this.leaf;
    }
}