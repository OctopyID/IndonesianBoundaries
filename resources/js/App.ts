import Boundary from "./Boundary";
import Collection from "./Collection";

declare var boundaries : any;

declare global
{
    interface Window
    {
        $boundary : Boundary
    }
}

window.$boundary = new Boundary(
    Collection.wrapRecursive(boundaries)
);