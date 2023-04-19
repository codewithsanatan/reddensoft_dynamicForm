<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReddenSoft Assignment</title>
</head>
<body>
    <h2>ReddenSoft Assignment</h2>
    <form action="{{url("home")}}" method="post" enctype="multipart/form-data">
        @csrf
        @foreach ($alldata->compliance as $data)
            @if (count($data->questions) > 0)
                @foreach ($data->questions as $item)
                    @if ($item->label != "")
                        <label for="{{$item->fields[0]->name}}">{{$item->label}}</label>
                    @endif
                    @switch($item->fields[0]->type)
                        @case("input_file")
                            <input type="file" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}" {{$item->required ? "required" : ""}}>
                            @break
                        @case("input_text")
                            <input type="text" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}" {{$item->required ? "required" : ""}}>
                            @break
                            @case("input_hidden")
                            <input type="text" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}} hidden"  {{$item->required ? "required" : ""}}>
                            @break
                        @case("textarea")
                            <textarea name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}" cols="30" rows="10"  {{$item->required ? "required" : ""}}></textarea>
                            @break
                        @case("multi_value_single_select")
                            {{-- {{$item->fields[0]->name}} --}}
                            @foreach ($item->fields[0]->values as $radio_value)
                                <input type="radio" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}{{$radio_value->value}}" value="{{$radio_value->value}}"  {{$item->required ? "required" : ""}}>{{$radio_value->label}}
                            @endforeach
                            @break
                        @case("multi_value_multi_select")

                            @break

                        @default

                    @endswitch
                    <br><br>
                @endforeach
            @endif
        @endforeach
        @foreach ($alldata->questions as $item)
            @if ($item->label != "")
            <label for="{{$item->fields[0]->name}}">{{$item->label}}</label>
            @endif
            @if (count($item->fields) > 1)
                @foreach ($item->fields as $field)
                <input type="radio" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}_{{$field->type}}" onchange="doActtion({{json_encode($item->fields)}}, {{json_encode($field)}});"/><label for="{{$item->fields[0]->name}}">{{$field->type}}</label>
                @endforeach
                @foreach ($item->fields as $field)
                    @switch($field->type)
                        @case("input_file")
                            <input type="file" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}{{$field->type}}_fld" {{$item->required ? "required" : ""}}>
                            @break
                        @case("input_text")
                            <input type="text" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}{{$field->type}}_fld" {{$item->required ? "required" : ""}}>
                            @break
                            @case("input_hidden")
                            <input type="text" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}{{$field->type}}_fld" hidden  {{$item->required ? "required" : ""}}>
                            @break
                        @case("textarea")
                            <textarea name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}{{$field->type}}_fld" cols="30" rows="10"  {{$item->required ? "required" : ""}}></textarea>
                            @break
                        @case("multi_value_single_select")
                            @foreach ($item->fields[0]->values as $radio_value)
                                <input type="radio" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}{{$radio_value->value}}" value="{{$radio_value->value}}"  {{$item->required ? "required" : ""}}>{{$radio_value->label}}
                            @endforeach
                            @break
                        @case("multi_value_multi_select")
                            @foreach ($item->fields[0]->values as $radio_value)
                                <input type="checkbox" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}{{$radio_value->value}}" value="{{$radio_value->value}}"  {{$item->required ? "required" : ""}}>{{$radio_value->label}}
                            @endforeach
                            @break

                        @default

                    @endswitch
                @endforeach
            @else
                @switch($item->fields[0]->type)
                    @case("input_file")
                        <input type="file" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}" required="{{$item->required}}">
                        @break
                    @case("input_text")
                        <input type="text" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}" required="{{$item->required}}">
                        @break
                        @case("input_hidden")
                        <input type="text" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}} hidden"  required="{{$item->required}}">
                        @break
                    @case("textarea")
                        <textarea name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}" cols="30" rows="10"  required="{{$item->required}}"></textarea>
                        @break
                    @case("multi_value_single_select")
                        @foreach ($item->fields[0]->values as $radio_value)
                            <input type="radio" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}{{$radio_value->value}}" value="{{$radio_value->value}}"  required="{{$item->required}}">{{$radio_value->label}}
                        @endforeach
                        @break
                    @case("multi_value_multi_select")
                        @foreach ($item->fields[0]->values as $radio_value)
                            <input type="checkbox" name="{{$item->fields[0]->name}}" id="{{$item->fields[0]->name}}{{$radio_value->value}}" value="{{$radio_value->value}}"  required="{{$item->required}}">{{$radio_value->label}}
                        @endforeach
                        @break

                    @default

                @endswitch
            @endif
            <br><br>
        @endforeach
        <button type="submit">Submit</button>
    </form>
    {{-- <form action="{{url("home")}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id="name"><br><br>
        <input type="text" name="subject" id="subject"><br><br>
        <input type="file" name="photo" id="photo"><br><br>
        <input type="checkbox" name="radio[]" id="radio1">radio1
        <input type="checkbox" name="radio[]" id="radio2">radio2
        <input type="checkbox" name="radio[]" id="radio3">radio3
        <textarea name="message" id="message" row="3"></textarea><br><br>
        <input type="submit" value="Submit">
    </form> --}}

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        function doActtion(allFields, radio){
            console.log(allFields, radio);
            // $(document).ready(function(){
            //     $("#"+ element.type + "_fld").attr("required", "true");
            // });
            allFields.forEach(element => {
                $(document).ready(function(){
                    if(element.type == radio.type){
                        console.log("#"+ element.name + "" + element.type + "_fld");
                        $("#"+ allFields[0].name + "" + element.type + "_fld").attr("required", true);
                        $("#"+ allFields[0].name + "" + element.type + "_fld").show();
                    }else{
                        $("#"+ allFields[0].name + "" + element.type + "_fld").attr("required", false);
                        $("#"+ allFields[0].name + "" + element.type + "_fld").hide();
                    }
                });
            });
        }
    </script>
</body>
</html>
