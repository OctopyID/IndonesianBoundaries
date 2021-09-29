import { stringify } from "querystring";
import Collection from "./Collection";

export default class Helper
{
    /**
     * @param  uri string
     * @return boolean
     */
    public static isURI(uri : string) : boolean {
        try {
            return new URL(uri).protocol.match(/http(s?):/) !== null;
        } catch (error) {
            return false;
        }
    }

    /***
     * @param icon string
     */
    public static getIcon(icon : string) : string {
        return '/vendor/octopyid/boundary/images/markers/' + icon;
    }

    /**
     * @param  region number|Collection
     * @return Promise<any>
     */
    public static async fetchGeometry(region : number | Collection<any>) : Promise<any> {
        let code = region instanceof Collection ? region.get('code') : region;

        return await fetch('https://boundary.octopy.dev/api/geometry?' + stringify({
            code: code
        }))
            .then(response => response.json());
    }

    /**
     * @param  region number|Collection
     * @return Promise<any>
     */
    public static async fetchRegions(region : number | Collection<any>) {
        let code = region instanceof Collection ? region.get('code') : region;

        return await fetch('https://boundary.octopy.dev/api/regions?' + stringify({
            code: code
        }))
            .then(response => response.json());
    }

    /**
     * @param region number
     */
    public static fetchCities(region : number) : Promise<any> {
        return Helper.fetchRegions(region).then(json => new Collection(json.cities));
    }

    /**
     * @param region number
     */
    public static fetchDistricts(region : number) : Promise<any> {
        return Helper.fetchRegions(region).then(json => new Collection(json.districts));
    }

    /**
     * @param region number
     */
    public static fetchVillages(region : number) : Promise<any> {
        return Helper.fetchRegions(region).then(json => new Collection(json.villages));
    }
}