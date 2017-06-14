
function Map(id) {
    var self = this;
    
    

    self.readWktFeature = function (wkt, dataProjection = 'EPSG:4326', featureProjection = 'EPSG:3857') {
	return format.readFeature(wkt, {
	    dataProjection: dataProjection,
	    featureProjection: featureProjection
	});
    }

    self.createStyle = function (fillColor, strokeColor, strokeWidth) {
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
}
