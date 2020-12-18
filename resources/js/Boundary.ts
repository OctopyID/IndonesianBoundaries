import 'reflect-metadata';
import { container } from 'tsyringe';

import BaseMap from './BaseMap';
import MapCollection from './MapCollection';

export class Boundary {

    /**
     * @protected data : Array
     */
    protected data : Array<any>;

    /**
     * @param data : <any>
     */
    public constructor(data : any) {
        for (let [root, value] of Object.entries(data)) {
            data[root] = new BaseMap(root, value);
        }

        this.data = Object.values(data);
    }

    /**
     * @return Promise<MapCollection>
     */
    public async render() : Promise<MapCollection> {
        let collection = container.resolve(MapCollection);

        for (let map of this.data) {
            map.drawBaseMap();
            map.addAttribution();

            if (map.tileLayer().isEnabled()) {
                map.tileLayer().drawBackground();
            }

            for (const region of map.getRegion()) {
                collection.merge({
                    [map.getRootElement()]: {
                        [region.getName()]: await region.draw(map)
                    }
                })
            }
        }

        return collection;
    }
}