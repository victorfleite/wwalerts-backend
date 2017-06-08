// CONVERSION COLOR HEX TO RGB
function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h};
function hexToR(h) {return parseInt((cutHex(h)).substring(0,2),16)};
function hexToG(h) {return parseInt((cutHex(h)).substring(2,4),16)};
function hexToB(h) {return parseInt((cutHex(h)).substring(4,6),16)};
function hexToRGB(h){return 'rgb('+hexToR(h)+','+hexToG(h)+','+hexToB(h)+')'};
function hexToRGBA(h, a){return 'rgba('+hexToR(h)+','+hexToG(h)+','+hexToB(h)+','+a+')'};
