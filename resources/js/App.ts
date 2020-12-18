import { Boundary } from './Boundary'

declare var boundaryConfig : any;

declare global {
    interface Window {
        $boundary : Boundary
    }
}

window.$boundary = (() => {
    return new Boundary(boundaryConfig)
})();