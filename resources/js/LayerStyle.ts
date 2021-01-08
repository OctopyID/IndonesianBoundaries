import { PathOptions, StyleFunction } from "leaflet";
import Region from "./Region";

export default class LayerStyle
{
    /**
     * @protected PathOptions | StyleFunction<any>;
     */
    protected default : PathOptions | StyleFunction<any>;

    /**
     * @param layer Region
     */
    public constructor(private layer : Region) {
        this.default = layer.options.style;
    }

    /**
     * @param stroke boolean
     */
    public stroke(stroke : boolean) {
        this.set({
            stroke
        });

        return this;
    }

    /**
     * @return void
     */
    public defaultStroke() {
        if ("stroke" in this.default) {
            this.stroke(this.default.stroke);
        }
    }

    /**
     * @param color string
     * @param delay number
     */
    public color(color : string, delay : number = 150) {
        setTimeout(() => {
            this.set({
                color
            });
        }, delay);
    }

    /**
     * @return void
     */
    public defaultColor() {
        if ("color" in this.default) {
            this.color(this.default?.color);
        }
    }

    /**
     * @param weight number
     */
    public weight(weight : number) {
        this.set({
            weight
        });
    }

    /**
     * @return void
     */
    public defaultWeight() {
        if ("weight" in this.default) {
            this.weight(this.default?.weight);
        }
    }

    /**
     * @param opacity number
     */
    public opacity(opacity : number) {
        this.set({
            opacity
        });
    }

    /**
     * @return void
     */
    public defaultOpacity() {
        if ("opacity" in this.default) {
            this.weight(this.default?.opacity);
        }
    }

    /**
     * @param fill  boolean
     * @param delay number
     */
    public fill(fill : boolean, delay : number = 150) {
        setTimeout(() => {
            this.set({
                fill
            });
        }, delay);
    }

    /**
     * @return void
     */
    public defaultFill() {
        if ("fill" in this.default) {
            this.fill(this.default?.fill);
        } else {
            this.fill("fillColor" in this.default);
        }
    }

    /**
     * @param fillColor string
     * @param delay     number
     */
    public fillColor(fillColor : string, delay : number = 150) {
        setTimeout(() => {
            this.set({
                fillColor
            });
        }, delay);
    }

    /**
     * @return void
     */
    public defaultFillColor() {
        if ("fillColor" in this.default) {
            this.fillColor(this.default?.fillColor);
        }
    }

    /**
     * @param fillOpacity number
     * @param delay       number
     */
    public fillOpacity(fillOpacity : number, delay : number = 150) {
        setTimeout(() => {
            this.set({
                fillOpacity
            });
        }, delay);
    }

    /**
     * @return void
     */
    public defaultFillOpacity() {
        if ("fillOpacity" in this.default) {
            this.fillOpacity(this.default?.fillOpacity);
        }
    }

    /**
     * @param fillRule string
     */
    public fillRule(fillRule : string) {
        this.set({
            fillRule
        });
    }

    /**
     * @return void
     */
    public defaultFillRule() {
        if ("fillRule" in this.default) {
            this.fillRule(this.default?.fillRule);
        }
    }

    /**
     * @param lineCap string
     */
    public lineCap(lineCap : string) {
        this.set({
            lineCap
        });
    }

    /**
     * @return void
     */
    public defaultLineCap() {
        if ("lineCap" in this.default) {
            this.lineCap(this.default?.lineCap);
        }
    }

    /**
     * @param lineJoin string
     */
    public lineJoin(lineJoin : string) {
        this.set({
            lineJoin
        });
    }

    /**
     * @return void
     */
    public defaultLineJoin() {
        if ("lineJoin" in this.default) {
            this.lineJoin(this.default?.lineJoin);
        }
    }

    /**
     * @return void
     */
    public defaultAll() {
        this.set(this.default);
    }

    /**
     * @param style object
     */
    public set(style : {}) {
        this.layer.setStyle(style);
    }
}