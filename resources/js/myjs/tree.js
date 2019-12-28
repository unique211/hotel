$(document).ready(function() {
    get_brand();

    if (role == "member") {

        $.get('get_member/' + userid, function(data) {
            //  alert();
            create_node(data[0].id);
        })

    }


    function get_brand() {
        // alert();


        $.get('get_all_members', function(data) {
            console.log(data);
            html = '';
            //alert(html);
            var name = '';
            html += '<option selected disabled value="">Select </option>';
            // html += '<option value="0">Parent</option>';
            for (i = 0; i < data.length; i++) {
                var id = '';
                // alert(data.length);
                name = data[i].name;
                id = data[i].id;
                html += '<option value="' + id + '" >' + name + '</option>';
            }
            $("#member").html(html);
        })


    }

    $(document).on('change', "#member", function() {

        id = $("#member").val();
        //   var data = create_tree(id).slow();
        //  alert(data);
        //  create_tree(id);
        //  nodes = [];
        create_node(id)
            //      tree_show();
    });
    // var name = "";
    var nodes = [];
    var text = "";
    var a_child = "";
    var b_child = "";
    var name = "";

    // create_tree(1);
    // var data = create_tree(4);
    // alert(name);
    var data = "";

    function create_node(id) {
        $.ajax({

            type: "GET",
            url: 'get_child/' + id,
            dataType: "JSON",
            async: false,
            success: function(data) {
                name = data;

                tree_show();
                // text = data.name;
                // a_child = data.a_child;
                // b_child = data.b_child;
                // create_tree1();
            }
        });
    }

    function create_tree1() {
        var p = "";
        var children = "";
        var name1 = "";
        p = '"text": { "name" : "' + text + '"}';
        // nodes = p;
        //   nodes.push(p);
        if (a_child != 0 && b_child == 0) {
            //text = "";
            create_node(a_child);

            name1 = '"children": [{"text": { "' + text + '" } }]';
            nodes.push('{' + p + ',' + name1 + '}');
            //   nodes.push(name1);
        } else if (b_child != 0 && a_child == 0) {
            //  text = "";
            create_node(b_child);

            name1 = '"children": [{"text": { "' + text + '" } }]';
            //   nodes.push(name1);
            nodes.push('{' + p + ',' + name1 + '}');
        } else if (a_child != 0 && b_child != 0) {
            create_tree(a_child);

            children += ' "text": { "name": "' + text + '" },';

            create_tree(b_child);
            //   text += '"text": { "name" : "' + data.name + '" },';
            children += ' "text": { "name": "' + text + '" }';

            name1 = '"children": [{' + children + '}]';
            //     name1 = '' + children + '}';
            nodes.push('{' + p + ',' + name1 + '}');
        } else {
            children = "";
            //  name1 = '';
            nodes.push('{' + p + '}');
        }

        //   nodes.push(name1);
        alert(nodes);
        //  tree_show(nodes);
    }

    function create_tree(id) {
        var text = "";
        var name1 = "";
        var children = '';
        var a = "";
        var b = "";

        $.ajax({

            type: "GET",
            url: 'get_child/' + id,
            dataType: "JSON",
            async: false,
            success: function(data) {
                text = '"text": { "name" : "' + data.name + '" }';
                if (data.a_child != 0 && data.b_child == 0) {

                    create_tree(data.a_child);
                    //    alert(child1);
                    //     text += '"text": { "name" : "' + data.name + '" },';

                    children += '{ "text": { "name": "' + data.name + '" }}';
                    //  text.append(children);
                    // $.ajax({
                    //     type: "GET",
                    //     url: 'get_child/' + data.a_child,
                    //     dataType: "JSON",
                    //     async: false,
                    //     success: function(data) {
                    //         children = '"children": [{ "text": { "name": "' + data.name + '" }}]';
                    //     }
                    // });

                    name1 = '{' + text + ',"children": [' + children + ']}';

                } else if (data.b_child != 0 && data.a_child == 0) {

                    create_tree(data.b_child);
                    //  text += '"text": { "name" : "' + data.name + '" },';
                    children += '{ "text": { "name": "' + data.name + '" }}';
                    //   text.append(children);
                    // $.ajax({
                    //     type: "GET",
                    //     url: 'get_child/' + data.b_child,
                    //     dataType: "JSON",
                    //     async: false,
                    //     success: function(data) {
                    //         children = '"children": [{ "text": { "name": "' + data.name + '" }}]';
                    //     }
                    // });

                    name1 = '{' + text + ',"children": [' + children + ']}';

                } else if (data.a_child != 0 && data.b_child != 0) {
                    //alert(create_tree(data.a_child).data());

                    create_tree(data.a_child);
                    create_tree(data.b_child);
                    //    text += '"text": { "name" : "' + data.name + '" },';
                    children += '"children": [{ "text": { "name": "' + data.name + '" }},';


                    //   text += '"text": { "name" : "' + data.name + '" },';
                    children += '{ "text": { "name": "' + data.name + '" }}]';
                    //    text.append(children);
                    // $.ajax({
                    //     type: "GET",
                    //     url: 'get_child/' + data.a_child,
                    //     dataType: "JSON",
                    //     async: false,
                    //     success: function(data) {
                    //         children += '"children": [{ "text": { "name": "' + data.name + '" }},';
                    //     }
                    // });
                    // $.ajax({
                    //     type: "GET",
                    //     url: 'get_child/' + data.b_child,
                    //     dataType: "JSON",
                    //     async: false,
                    //     success: function(data) {
                    //         children += '{ "text": { "name": "' + data.name + '" }}]';
                    //     }
                    // });

                    name1 = '{' + text + ',' + children + '}';


                } else {

                    children = "";
                    name1 = '{' + text + '}';

                }
                //  text.push(children);
                name = name1;

                //  name.append(name1);
                //   name = ' {' + text + '}';

                //   alert(name);
                //  return text;
            },
            complete: function(jqXHR, status) {

                tree_show(name);
            }
        });




    }





    function tree_show() {
        console.log(name);
        //  var node = name;
        var id = $("#member").val();
        var simple_chart_config = {
            chart: {
                container: "#collapsable-example",
                animateOnInit: true,
                node: {
                    collapsable: true
                },
                animation: {
                    nodeAnimation: "easeOutBounce",
                    nodeSpeed: 700,
                    connectorsAnimation: "bounce",
                    connectorsSpeed: 700
                }
            },
            nodeStructure: JSON.parse(JSON.stringify(name))

            // nodeStructure: {
            //     text: { name: "name" },
            //     children: [{
            //             text: { name: "name2" },
            //         },
            //         {
            //             text: { name: "Sagar Morvadiya" },
            //             children: [{
            //                     text: { name: "Sagar Morvadiya" }
            //                 },
            //                 {
            //                     text: { name: "Ajazkhan Pathan" }
            //                 }
            //             ]
            //         }
            //     ]
            // }
        };
        tree = new Treant(simple_chart_config);

    }



});
