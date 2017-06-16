/**
 * 
 *  Javascript common libaries to use in map
 *  @author: victor.leite@gmail.com
 *  
 */

/**
 * Get Format WKT
 * @returns {ol.format.WKT}
 */
function getFormat() {
    return new ol.format.WKT();
}
/**
 * Read feature from wkt
 * @param {type} wkt
 * @param {type} dataProjection
 * @param {type} featureProjection
 * @returns {unresolved}
 */
function readWktFeature(wkt, dataProjection = 'EPSG:4326', featureProjection = 'EPSG:3857') {
    return getFormat().readFeature(wkt, {
	dataProjection: dataProjection,
	featureProjection: featureProjection
    });
}
/**
 * Create Style for features
 * @param {type} fillColor
 * @param {type} strokeColor
 * @param {type} strokeWidth
 * @returns {ol.style.Style}
 */
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
/**
 * Set Map zoom from a single Feature of Map
 * @param {type} map
 * @returns {undefined}
 */
function setMapCenterFromFeature(map){
    var extent;
    var feature = map.getLayers().getArray()[1].getSource().getFeatures()[0];
    extent = feature.getGeometry().getExtent();
    map.getView().fit(extent,map.getSize());
}

/**
 * Set Map zoom from all Feature of Map
 * @param {type} map
 * @returns {undefined}
 */
function setMapCenterFromFeatures(map){
    var extent = map.getLayers().getArray()[1].getSource().getExtent();
    map.getView().fit(extent, map.getSize());    
}
