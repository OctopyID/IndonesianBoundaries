import Collection from "./Collection";

export default class Config {
    protected conf : Collection;

    protected readonly root : string;

    constructor(root : string, conf : Collection) {
        this.conf = conf;
        this.root = root;
    }

    public config(key : string, value : any) {
        if (key) {
            return this.conf.get(key, value);
        }

        return this.conf;
    }

    public getRootElement() : string {
        return this.root;
    }

    public getMapOptions() : object {
        return {
            center: [
                this.conf.get('center.lat'),
                this.conf.get('center.lng'),
            ],
            ...this.conf.get('options').reverse(),
        };
    }
}