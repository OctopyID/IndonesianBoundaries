import Collection from "./Collection";
import Config from "./Config";
import Map from "./Map";

export default class Boundary {

    private collection : Collection;

    constructor(collection : Collection) {
        this.collection = collection;
    }

    private static getCollection() : Collection {
        let collection = new Collection;

        collection.macro('element', function (dom : string) {
            let result = this.skipWhile(map => ! map.hasElement(dom));

            if (result.count() === 0) {
                throw new DOMException(`Cannot find DOM with ID ${ dom }, make sure <div id="${ dom }"> is available.`);
            }

            return result.first();
        });

        collection.macro('elements', function (callback : CallableFunction) {
            return this.map(map => {
                return map.regions(callback);
            });
        });

        return collection;
    }

    public async render() : Promise<Collection> {
        let collection = Boundary.getCollection();
        this.collection.map(async (config : Collection, element : string) => {
            collection.push(
                await (new Map(new Config(element, config))).render()
            );
        });

        return collection;
    }
}