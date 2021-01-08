import Collection from "./Collection";
import Map from "./Map";

export default class Boundary
{
    /**
     * @var boundaries Collection
     */
    private boundaries : Collection<any>;

    /**
     * @param boundaries Collection
     */
    public constructor(boundaries : Collection<any>) {
        this.boundaries = boundaries.map((config : Collection<any>, containerID : string) => {
            return new Map(containerID, config);
        });
    }

    /**
     * @param fn CallableFunction | null
     */
    public render(fn : CallableFunction | null = null) : Collection<any> {
        let boundaries = this.boundaries.map((map : Map) => {
            return map.render();
        });

        this.macro(boundaries);

        if (fn) {
            fn(boundaries);
        }

        return boundaries;
    }

    /**
     * @param  boundaries
     * @return void
     */
    private macro(boundaries : Collection<Map>) : void {
        boundaries.macro('elements', (fn : CallableFunction) => {
            boundaries.each(boundary => fn(boundary));
        });

        boundaries.macro('element', (element : string, fn : CallableFunction = null) => {
            let search = boundaries.filter((boundary, name) => {
                return name === element;
            });

            if (search.count()) {
                let boundary = search.first();

                if (fn) {
                    fn(boundary);
                }

                return boundary;
            }

            throw new Error(`No container element with id ${ element } was found`);
        });
    }
}