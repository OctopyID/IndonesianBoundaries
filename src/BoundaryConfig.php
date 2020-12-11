<?php

namespace Octopy\Indonesian\Boundaries;

class BoundaryConfig
{
    /**
     * @var array
     */
    protected array $config = [
        'element' => 'map',
        'layer'   => [],
        'zoom'    => [
            'zoom'            => 5,
            'scrollWheelZoom' => true,
            'zoomControl'     => true,
        ],
        'render'  => [
            'type'   => 'part',
            'center' => [
                'lat' => -0.789275,
                'lng' => 113.921327,
            ],
            'data'   => [
                'city'     => [],
                'province' => [],
            ],
        ],
    ];

    /**
     * @var array
     */
    protected array $search = [];

    /**
     * Boundary constructor.
     */
    public function __construct()
    {
        $this->initDefaultConfig();
    }

    /**
     * @param  string $element
     */
    public function setElement(string $element)
    {
        $this->config['element'] = $element;
    }

    /**
     * @param  string $type
     */
    public function renderType(string $type = 'part')
    {
        $this->config['render']['type'] = $type;
    }

    /**
     * @param  float $lat
     * @param  float $lng
     */
    public function setCenter(float $lat, float $lng)
    {
        $this->config['render']['center'] = compact('lat', 'lng');
    }

    /**
     * @param  array $zoom
     */
    public function setZoom(array $zoom)
    {
        $this->config['zoom'] = array_merge($this->config['zoom'], $zoom);
    }

    /**
     * @param  bool $layer
     */
    public function withBackgroundLayer(bool $layer = true)
    {
        $this->config['layer']['background'] = $layer;
    }

    /**
     * @param  array $style
     */
    public function layerStyle(array $style)
    {
        $this->config['layer']['style'] = $style;
    }

    /**
     * @param  array $event
     */
    public function mouseEvent(array $event = [])
    {
        $this->config['layer']['event']['mouse'] = $event;
    }

    /**
     * @param  array $marker
     */
    private function setMarker(array $marker)
    {
        $this->config['marker'] = $marker;
    }

    /**
     * @param  array $search
     */
    public function search(array $search)
    {
        $this->config['render']['data'] = array_merge($this->config['render']['data'], $search);
    }

    /**
     * @return array
     */
    public function all() : array
    {
        return $this->config;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return $this->config;
    }

    /**
     * @return  void
     */
    private function initDefaultConfig()
    {
        $this->withBackgroundLayer(
            config('boundary.layer.background', true)
        );

        $this->layerStyle(config('boundary.layer.style', [
            'color'       => 'black',
            'weight'      => 0.1,
            'opacity'     => 0.4,
            'fillColor'   => 'red',
            'fillOpacity' => 0.3,
        ]));

        $this->mouseEvent(config('boundary.layer.event', [
            'click'     => 'highlight',
            'mouseover' => 'highlight',
            'mouseout'  => 'reset',
        ]));

        $this->renderType(
            config('boundary.render', 'part') ?? 'part'
        );

        $this->setElement(
            config('boundary.element', 'map') ?? 'map'
        );

        if (config('boundary.marker.iconUrl') !== false || config('boundary.marker.iconUrl') !== null) {
            $marker = config('boundary.marker', [
                'icon'        => 'default',
                'iconSize'    => [30, 30],
                'iconAnchor'  => [12, 25],
                'popupAnchor' => [1, -34],
                'shadowSize'  => [41, 41],
            ]);

            if ($marker['iconUrl'] === 'default') {
                $marker['iconUrl'] = asset('/vendor/boundary/images/marker.png');
            }

            $this->setMarker($marker);
        }
    }
}