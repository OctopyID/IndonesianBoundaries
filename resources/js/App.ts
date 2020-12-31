import Boundary from "./Boundary";
import Collection from "./Collection";

declare var boundaryConfig : any;

declare global {
    interface Window {
        $boundary : Boundary
    }
}

const collect = collection => new Collection(collection).map(item => {
    if (typeof item === 'object') {
        return collect(item);
    }

    return item;
});

window.$boundary = (() => {
    return new Boundary(collect(boundaryConfig));
})();