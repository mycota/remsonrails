function createLine(x1, y1, x2, y2)
    {
        if (x2 < x1)
        {
            var temp = x1;
            x1 = x2;
            x2 = temp;
            temp = y1;
            y1 = y2;
            y2 = temp;
        }
        var line = document.createElement("div");
        line.className = "line";
        var length = Math.sqrt((x1-x2)*(x1-x2) + (y1-y2)*(y1-y2));
        line.style.width = length + "px";

        if (isIE)
        {
            line.style.top = (y2 > y1) ? y1 + "px" : y2 + "px";
            line.style.left = x1 + "px";
            var nCos = (x2-x1)/length;
            var nSin = (y2-y1)/length;
            line.style.filter = "progid:DXImageTransform.Microsoft.Matrix(sizingMethod='auto expand', M11=" + nCos + ", M12=" + -1*nSin + ", M21=" + nSin + ", M22=" + nCos + ")";
        }
        else
        {
            var angle = Math.atan((y2-y1)/(x2-x1));
            line.style.top = y1 + 0.5*length*Math.sin(angle) + "px";
            line.style.left = x1 - 0.5*length*(1 - Math.cos(angle)) + "px";
            line.style.MozTransform = line.style.WebkitTransform = line.style.OTransform= "rotate(" + angle + "rad)";
        }
        return line;
    }