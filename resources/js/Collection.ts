import { Collection as BaseCollection } from 'collect.js';

export default class Collection<T> extends BaseCollection<any>
{

    /**
     * @param key   string
     * @param value mixed
     */
    public get<K, V>(key, value = null) : any {
        let item;
        for (let name of key.split('.')) {
            item = item ? item.get(name) : super.get(name);

            if (! item) {
                return value;
            }
        }

        return item;
    }

    /**
     * @return any
     */
    public reverse() : any {
        return this.map((item) => {
            if (item instanceof BaseCollection) {
                return super.unwrap(item);
            }

            return item;
        }).all();
    }

    /**
     * @param items Collection<any>
     */
    public static wrapRecursive<I>(items : object | Array<any>) : Collection<any> {
        return new Collection(items).map(item => {
            if (typeof item === 'object') {
                return Collection.wrapRecursive(item);
            }

            return item;
        });
    }
}