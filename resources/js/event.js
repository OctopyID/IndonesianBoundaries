export default {
    highlight: (e) => {
        style(e);
        e.target.setStyle({
            weight: 1.5,
            color: 'black',
            fillOpacity: 1
        });
    }

}