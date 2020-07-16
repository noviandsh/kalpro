// JQUERY NO CONFLICT
const $j = jQuery.noConflict();

// DATE PICKER FUNCTION
let tgl = new Date();
tgl.setHours(tgl.getHours()+1);
$j("#startDate").datetimepicker({ 
    minDate: tgl,
    changeMonth: true,
    dateFormat: "yy-mm-dd",
    onSelect: function(date){
        let selectedDate = new Date(date);
        let msecsInADay = 86400000;
        let endDate = new Date(selectedDate.getTime() + msecsInADay);

        //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
        $j("#dueDate").datepicker( "option", "minDate", endDate );
    }
});

$j("#dueDate").datetimepicker({ 
    dateFormat: 'yy-mm-dd',
    changeMonth: true
});

// GOJS FLOWCHART

// function init() {
    const draft = { 
        "class": "GraphLinksModel",
        "linkFromPortIdProperty": "fromPort",
        "linkToPortIdProperty": "toPort"
    };
    if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var $ = go.GraphObject.make;  // for conciseness in defining templates

    myDiagram =
        $(go.Diagram, "myDiagramDiv",  // must name or refer to the DIV HTML element
        {
            "LinkDrawn": showLinkLabel,  // this DiagramEvent listener is defined below
            "LinkRelinked": showLinkLabel,
            "undoManager.isEnabled": true  // enable undo & redo
        });

    // when the document is modified, add a "*" to the title and enable the "Save" button
    myDiagram.addDiagramListener("Modified", function(e) {
        var button = document.getElementById("SaveButton");
        if (button) button.disabled = !myDiagram.isModified;
        var idx = document.title.indexOf("*");
        if (myDiagram.isModified) {
            if (idx < 0) document.title += "*";
        } else {
            if (idx >= 0) document.title = document.title.substr(0, idx);
        }
    });

    // helper definitions for node templates

    function nodeStyle() {
        return [
        // The Node.location comes from the "loc" property of the node data,
        // converted by the Point.parse static method.
        // If the Node.location is changed, it updates the "loc" property of the node data,
        // converting back using the Point.stringify static method.
        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
        {
            // the Node.location is at the center of each node
            locationSpot: go.Spot.Center
        }
        ];
    }

    // Define a function for creating a "port" that is normally transparent.
    // The "name" is used as the GraphObject.portId,
    // the "align" is used to determine where to position the port relative to the body of the node,
    // the "spot" is used to control how links connect with the port and whether the port
    // stretches along the side of the node,
    // and the boolean "output" and "input" arguments control whether the user can draw links from or to the port.
    function makePort(name, align, spot, output, input) {
        var horizontal = align.equals(go.Spot.Top) || align.equals(go.Spot.Bottom);
        // the port is basically just a transparent rectangle that stretches along the side of the node,
        // and becomes colored when the mouse passes over it
        return $(go.Shape,
        {
            fill: "transparent",  // changed to a color in the mouseEnter event handler
            strokeWidth: 0,  // no stroke
            width: horizontal ? NaN : 8,  // if not stretching horizontally, just 8 wide
            height: !horizontal ? NaN : 8,  // if not stretching vertically, just 8 tall
            alignment: align,  // align the port on the main Shape
            stretch: (horizontal ? go.GraphObject.Horizontal : go.GraphObject.Vertical),
            portId: name,  // declare this object to be a "port"
            fromSpot: spot,  // declare where links may connect at this port
            fromLinkable: output,  // declare whether the user may draw links from here
            toSpot: spot,  // declare where links may connect at this port
            toLinkable: input,  // declare whether the user may draw links to here
            cursor: "pointer",  // show a different cursor to indicate potential link point
            mouseEnter: function(e, port) {  // the PORT argument will be this Shape
            if (!e.diagram.isReadOnly) port.fill = "rgba(255,0,255,0.5)";
            },
            mouseLeave: function(e, port) {
            port.fill = "transparent";
            }
        });
    }

    function textStyle() {
        return {
        font: "bold 11pt Lato, Helvetica, Arial, sans-serif",
        stroke: "#F8F8F8"
        }
    }

    // define the Node templates for regular nodes

    myDiagram.nodeTemplateMap.add("Process",  // the default category
        $(go.Node, "Table", nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
            $(go.Shape, "Rectangle",
            { fill: "#282c34", stroke: "#00A9C9", strokeWidth: 3.5 },
            new go.Binding("figure", "figure")),
            $(go.TextBlock, textStyle(),
            {
                margin: 8,
                maxSize: new go.Size(160, NaN),
                wrap: go.TextBlock.WrapFit,
                editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, go.Spot.TopSide, false, true),
        makePort("L", go.Spot.Left, go.Spot.LeftSide, true, true),
        makePort("R", go.Spot.Right, go.Spot.RightSide, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.BottomSide, true, false)
        ));

    myDiagram.nodeTemplateMap.add("Conditional",
        $(go.Node, "Table", nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
            $(go.Shape, "Diamond",
            { fill: "#282c34", stroke: "#00A9C9", strokeWidth: 3.5 },
            new go.Binding("figure", "figure")),
            $(go.TextBlock, textStyle(),
            {
                margin: 8,
                maxSize: new go.Size(160, NaN),
                wrap: go.TextBlock.WrapFit,
                editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, go.Spot.Top, false, true),
        makePort("L", go.Spot.Left, go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.Bottom, true, false)
        ));

    myDiagram.nodeTemplateMap.add("Start",
        $(go.Node, "Table", nodeStyle(),
        $(go.Panel, "Spot",
            $(go.Shape, "Circle",
            { desiredSize: new go.Size(70, 70), fill: "#282c34", stroke: "#09d3ac", strokeWidth: 3.5 }),
            $(go.TextBlock, "Start", textStyle(),
            new go.Binding("text"))
        ),
        // three named ports, one on each side except the top, all output only:
        makePort("L", go.Spot.Left, go.Spot.Left, true, false),
        makePort("R", go.Spot.Right, go.Spot.Right, true, false),
        makePort("B", go.Spot.Bottom, go.Spot.Bottom, true, false)
        ));

    myDiagram.nodeTemplateMap.add("End",
        $(go.Node, "Table", nodeStyle(),
        $(go.Panel, "Spot",
            $(go.Shape, "Circle",
            { desiredSize: new go.Size(60, 60), fill: "#282c34", stroke: "#DC3C00", strokeWidth: 3.5 }),
            $(go.TextBlock, "End", textStyle(),
            new go.Binding("text"))
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("T", go.Spot.Top, go.Spot.Top, false, true),
        makePort("L", go.Spot.Left, go.Spot.Left, false, true),
        makePort("R", go.Spot.Right, go.Spot.Right, false, true)
        ));

    // taken from ../extensions/Figures.js:
    go.Shape.defineFigureGenerator("File", function(shape, w, h) {
        var geo = new go.Geometry();
        var fig = new go.PathFigure(0, 0, true); // starting point
        geo.add(fig);
        fig.add(new go.PathSegment(go.PathSegment.Line, .75 * w, 0));
        fig.add(new go.PathSegment(go.PathSegment.Line, w, .25 * h));
        fig.add(new go.PathSegment(go.PathSegment.Line, w, h));
        fig.add(new go.PathSegment(go.PathSegment.Line, 0, h).close());
        var fig2 = new go.PathFigure(.75 * w, 0, false);
        geo.add(fig2);
        // The Fold
        fig2.add(new go.PathSegment(go.PathSegment.Line, .75 * w, .25 * h));
        fig2.add(new go.PathSegment(go.PathSegment.Line, w, .25 * h));
        geo.spot1 = new go.Spot(0, .25);
        geo.spot2 = go.Spot.BottomRight;
        return geo;
    });

    myDiagram.nodeTemplateMap.add("Document",  // the default category
        $(go.Node, "Table", nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
            $(go.Shape, "Document",
            { fill: "#282c34", stroke: "#00A9C9", strokeWidth: 3.5 },
            new go.Binding("figure", "figure")),
            $(go.TextBlock, textStyle(),
            {
                margin: 8,
                maxSize: new go.Size(160, NaN),
                wrap: go.TextBlock.WrapFit,
                editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, go.Spot.TopSide, false, true),
        makePort("L", go.Spot.Left, go.Spot.LeftSide, true, true),
        makePort("R", go.Spot.Right, go.Spot.RightSide, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.BottomSide, true, false)
        ));

    myDiagram.nodeTemplateMap.add("Input",  // the default category
        $(go.Node, "Table", nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
            $(go.Shape, "Input",
            { fill: "#282c34", stroke: "#00A9C9", strokeWidth: 3.5 },
            new go.Binding("figure", "figure")),
            $(go.TextBlock, textStyle(),
            {
                margin: 8,
                maxSize: new go.Size(160, NaN),
                wrap: go.TextBlock.WrapFit,
                editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, go.Spot.TopSide, false, true),
        makePort("L", go.Spot.Left, go.Spot.LeftSide, true, true),
        makePort("R", go.Spot.Right, go.Spot.RightSide, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.BottomSide, true, false)
        ));

    // replace the default Link template in the linkTemplateMap
    myDiagram.linkTemplate =
        $(go.Link,  // the whole link panel
        {
            routing: go.Link.AvoidsNodes,
            curve: go.Link.JumpOver,
            corner: 5, toShortLength: 4,
            relinkableFrom: true,
            relinkableTo: true,
            reshapable: true,
            resegmentable: true,
            // mouse-overs subtly highlight links:
            mouseEnter: function(e, link) { link.findObject("HIGHLIGHT").stroke = "rgba(30,144,255,0.2)"; },
            mouseLeave: function(e, link) { link.findObject("HIGHLIGHT").stroke = "transparent"; },
            selectionAdorned: false
        },
        new go.Binding("points").makeTwoWay(),
        $(go.Shape,  // the highlight shape, normally transparent
            { isPanelMain: true, strokeWidth: 8, stroke: "transparent", name: "HIGHLIGHT" }),
        $(go.Shape,  // the link path shape
            { isPanelMain: true, stroke: "gray", strokeWidth: 2 },
            new go.Binding("stroke", "isSelected", function(sel) { return sel ? "dodgerblue" : "gray"; }).ofObject()),
        $(go.Shape,  // the arrowhead
            { toArrow: "standard", strokeWidth: 0, fill: "gray" }),
        $(go.Panel, "Auto",  // the link label, normally not visible
            { visible: false, name: "LABEL", segmentIndex: 2, segmentFraction: 0.5 },
            new go.Binding("visible", "visible").makeTwoWay(),
            $(go.Shape, "RoundedRectangle",  // the label shape
            { fill: "#F8F8F8", strokeWidth: 0 }),
            $(go.TextBlock, "Yes",  // the label
            {
                textAlign: "center",
                font: "10pt helvetica, arial, sans-serif",
                stroke: "#333333",
                editable: true
            },
            new go.Binding("text").makeTwoWay())
        )
        );

        // Make link labels visible if coming out of a "conditional" node.
        // This listener is called by the "LinkDrawn" and "LinkRelinked" DiagramEvents.
        function showLinkLabel(e) {
            var label = e.subject.findObject("LABEL");
            if (label !== null) label.visible = (e.subject.fromNode.data.category === "Conditional");
        }

        // temporary links used by LinkingTool and RelinkingTool are also orthogonal:
        myDiagram.toolManager.linkingTool.temporaryLink.routing = go.Link.Orthogonal;
        myDiagram.toolManager.relinkingTool.temporaryLink.routing = go.Link.Orthogonal;

        // load();  // load an initial diagram from some JSON text

        // initialize the Palette that is on the left side of the page
        myPalette =
            $(go.Palette, "myPaletteDiv",  // must name or refer to the DIV HTML element
            {
                // Instead of the default animation, use a custom fade-down
                "animationManager.initialAnimationStyle": go.AnimationManager.None,
                "InitialAnimationStarting": animateFadeDown, // Instead, animate with this function

                nodeTemplateMap: myDiagram.nodeTemplateMap,  // share the templates used by myDiagram
                model: new go.GraphLinksModel([  // specify the contents of the Palette
                { category: "Start", text: "Start" },
                { category: "Process", text: "Step" },
                { category: "Conditional", text: "???" },
                { category: "Document", text: "Document" },
                { category: "Input", text: "Input" },
                { category: "End", text: "End" }
                ])
            });

        // This is a re-implementation of the default animation, except it fades in from downwards, instead of upwards.
        function animateFadeDown(e) {
            var diagram = e.diagram;
            var animation = new go.Animation();
            animation.isViewportUnconstrained = true; // So Diagram positioning rules let the animation start off-screen
            animation.easing = go.Animation.EaseOutExpo;
            animation.duration = 900;
            // Fade "down", in other words, fade in from above
            animation.add(diagram, 'position', diagram.position.copy().offset(0, 200), diagram.position);
            animation.add(diagram, 'opacity', 0, 1);
            animation.start();
        }

    // } // end init


    // Show the diagram's model in JSON format that the user may edit
    function save() {
        document.getElementById("mySavedModel").value = myDiagram.model.toJson();
        myDiagram.isModified = false;
    }
    function load() {
        myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
    }

// print the diagram by opening a new window holding SVG images of the diagram contents for each page
function printDiagram() {
    // var svgWindow = window.open();
    // if (!svgWindow) return;  // failure to open a new Window
    var printSize = new go.Size(700, 960);
    var bnds = myDiagram.documentBounds;
    var x = bnds.x;
    var y = bnds.y;
    var s = new XMLSerializer();
    while (y < bnds.bottom) {
        while (x < bnds.right) {
        var svg = myDiagram.makeSVG({ scale: 1.0, position: new go.Point(x, y), size: printSize });
        x += printSize.width;
        }
        x = bnds.x;
        y += printSize.height;
    }
    var str = s.serializeToString(svg);
    var encod = encodeURIComponent(str)
    return encod;
}

if(window.location.pathname.includes("edit-quiz")){
    myDiagram.model = go.Model.fromJson(savedDiagram);
}else{
    myDiagram.model = go.Model.fromJson(draft);
}
// fungsi submit kuis
function editQuiz() {
    let id = $j('#quiz-id').val();
    let quizDetail = {
      'title' : $j('#quiz-title').val(),
      'date' : $j('#startDate').val(),
      'dueDate' : $j('#dueDate').val(),
      'duration' : $j('#quiz-duration').val(),
    };
    let answer = myDiagram.model.toJson();
    $j.ajax({
        type  : 'POST',
        url   : baseUrl+'dataprocess/editquiz',
        // dataType: 'json',
        data : {'quizDetail': quizDetail, 'question': $j('#question-form').val(), 'answer': answer, svg: printDiagram(), 'id': id},
        beforeSend: function () {
            // ... your initialization code here (so show loader) ...
            $j('#loading').show();
        },
        complete: function () {
            // ... your finalization code here (hide loader) ...
            $j('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert("Gagal menyimpan kuis, coba lagi!");
        },
        success : function(data){
            history.go(-1);
        }
    });
}
// fungsi submit kuis
function submitQuiz() {
    let quizDetail = {
      'id' : $j('#quiz-id').val(),
      'teacher' : $j('#quiz-teacher').val(),
      'classID' : $j('#quiz-classID').val(),
      'title' : $j('#quiz-title').val(),
      'date' : $j('#startDate').val(),
      'dueDate' : $j('#dueDate').val(),
      'duration' : $j('#quiz-duration').val()
    };
    let answer = myDiagram.model.toJson();
    $j.ajax({
        type  : 'POST',
        url   : baseUrl+'dataprocess/newQuestion',
        // dataType: 'json',
        data : {'quizDetail': quizDetail, 'question': $j('#question-form').val(), 'answer': answer, svg: printDiagram()},
        beforeSend: function () {
            // ... your initialization code here (so show loader) ...
            $j('#loading').show();
        },
        complete: function () {
            // ... your finalization code here (hide loader) ...
            $j('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert("Gagal menyimpan kuis, coba lagi!");
        },
        success : function(data){
            history.go(-1);
        }
    });
}

// FUNGSI START QUIZ
function countDown() {
    let date = Math.round((timeLimit-new Date())/1000);
    let hours = Math.floor(date/3600);
    date = date - (hours*3600);
    let mins = Math.floor(date/60);
    date = date - (mins*60);
    let secs = date;
    if (hours<10) hours = '0'+hours;
    if (mins<10) mins = '0'+mins;
    if (secs<10) secs = '0'+secs;
    $j('#timer').html(hours+':'+mins+':'+secs);
    let coba = setTimeout("countDown()",1000);
    if(hours == 0 && mins == 0 && secs == 0){
        clearTimeout(coba);
        submitAnswer();
    }
}

function submitAnswer() {
    let answer = myDiagram.model.toJson();
    $j.ajax({
        type  : 'POST',
        url   : baseUrl+'dataprocess/submitAnswer/'+quizID,
        // dataType: 'json',
        data : {'answer': answer, 'svg': printDiagram()},
        beforeSend: function () {
            // ... your initialization code here (so show loader) ...
            $j('#loading').show();
        },
        complete: function () {
            // ... your finalization code here (hide loader) ...
            $j('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert(errorThrown.status);
        },
        success : function(data){
            console.log(data);
            window.location.replace(baseUrl+'start-quiz/'+quizID+'/result');
        }
    });
}
function loadVideo(file){
    $j('#modal-tutorial>video>source').attr('src', baseUrl+'assets/video/'+file+'.mp4');
    $j('#modal-tutorial>video').get(0).load();
    $j('#modal-tutorial>video').get(0).play();
}
$j('#tutorial-button').click(function(){
    $j("#modal-tutorial").modal({
        fadeDuration: 100
    });
    file = $j("#modal-tutorial li.active").attr('title');
    loadVideo(file);
});
let nav = 1;
$j('.nav-btn').click(function(){
    console.log(nav);
    $j("#modal-tutorial li#nav-"+nav).removeClass('active');
    nav == 6 ? nav = 1 : nav++;
    console.log(nav);
    $j("#modal-tutorial li#nav-"+nav).addClass('active');
    file = $j("#modal-tutorial li.active").attr('title');
    loadVideo(file);
})

if(window.location.pathname.includes("start-quiz")){
    countDown();
}