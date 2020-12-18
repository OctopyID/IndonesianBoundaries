import { singleton } from 'tsyringe';

@singleton()
export default class MapCollection {

    /**
     * @protected items: object
     */
    protected items : object;

    /**
     * MapCollection constructor
     */
    public constructor() {
        this.items = {};
    }

    /**
     * @param items : object
     */
    public merge(items : object) : void {
        this.items = {
            ...this.items, ...items
        }
    }

    /**
     * @param key   : string
     * @param value : <any>
     */
    public get(key : string, value : any) {
        let item = this.items;
        for (let name of key.split('.')) {
            if (item[name] === undefined) {
                return value;
            }

            item = item[name];
        }

        return item;
    }
}
