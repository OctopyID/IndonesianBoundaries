// @ts-ignore
import * as L from "leaflet";
import TileLayer from "./TileLayer";
import Region from "./Region";

export default class BaseMap {

    /**
     * @protected
     */
    protected data : any;

    /**
     * @protected
     */
    protected root : string;

    /**
     * @protected
     */
    protected leaf : L.Map;

    /**
     * @param root
     * @param data
     */
    constructor(root : string, data : any) {
        this.root = root;
        this.data = data;
    }

    /**
     * @return string
     */
    public getRootElement = () : string => this.root;

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

    public addAttribution() {
        this.leaf.attributionControl.addAttribution(
            '<a href="https://bit.ly/IndonesianBoundaries">Octopy ID</a> | <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        );
    }

    public getLeafletInstance() : L.Map {
        return this.leaf;
    }
}