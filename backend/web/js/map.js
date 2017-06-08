var format = new ol.format.WKT();

function readWktFeature(wkt, dataProjection = 'EPSG:4326', featureProjection = 'EPSG:3857') {
    return format.readFeature(wkt, {
	dataProjection: dataProjection,
	featureProjection: featureProjection
    });
}

function createStyle(fillColor, strokeColor, strokeWidth) {
    var myStyle = new ol.style.Style({
	fill: new ol.style.Fill({
	    color: fillColor
	}),
	stroke: new ol.style.Stroke({
	    color: strokeColor,
	    width: strokeWidth
	}),
    });
    return myStyle;

}
