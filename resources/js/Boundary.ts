import BaseMap from "./BaseMap";
import Region from "./Region";

export class Boundary {

    protected data : Array<any>;

    /**
     * @param data
     */
    public constructor(data : any) {
        for (let [root, value] of Object.entries(data)) {
            data[root] = new BaseMap(root, value);
        }

        this.data = Object.values(data);
    }

    render() {
        this.data.map((map : BaseMap) => {
            map.drawBaseMap();
            map.addAttribution();

            if (map.tileLayer().isEnabled()) {
                map.tileLayer().drawBackground();
            }

            map.getRegion().map((region : Region) => {
                region.draw(map);
            })
        });
    }
}