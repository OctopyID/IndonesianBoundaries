import { Collection as BaseCollection } from 'collect.js'

export default class Collection extends BaseCollection<any> {
    /**
     * @param key : string
     * @param value : <unknown>
     */
    public get<K, V>(key, value = null) {

        if (Number.isInteger(key)) {
            console.log(key);
            return super.get(key, value);
        }

        let item;
        for (let name of key.split('.')) {
            item = item ? item.get(name) : super.get(name);

            if (! item) {
                return value;
            }
        }

        return item;
    }

    public reverse() : any {
        return this.map((item) => {
            if (item instanceof BaseCollection) {
                return this.unwrap(item);
            }

            return item;
        }).all();
    }
}