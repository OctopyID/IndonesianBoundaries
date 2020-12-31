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

        collection.macro('element', function (element : string) {
            return this.skipWhile(map => ! map.hasElement(element)).first();
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