<table id="dg" title="Lista de Usuarios" class="easyui-datagrid" style="width:100%;height:250px; margin:10px;"
            url="controlador/usuario.php?op=select"
            toolbar="#toolbar" pagination="false" 
            rownumbers="true" fitColumns="false" singleSelect="true">
        <thead>
            <tr>               
                <th field="login" width="100"># Proceso Interno</th>
                <th field="nombre" width="100"># Expediente</th>
                <th field="nombre" width="100">Juez/Fiscal/Autoridad a Cargo</th>
                <th field="nombre" width="100">Cliente</th>
                <th field="nombre" width="100">Contraparte/Accion</th>
                <th field="nombre" width="100">Ingresos/Despachos</th>
                <th field="nombre" width="100">Actividad</th>
                <th field="nombre" width="100">Fecha</th>
               
            </tr>
        </thead>
    </table>
    
    <div id="toolbar">
       <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Información</h3>
            <div style="margin-bottom:10px">
                <input name="login" class="easyui-textbox" required="true" label="# Proceso:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="# Expediente:" style="width:100%">
            </div> 
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Autoridad:" style="width:100%">
            </div> 
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Cliente:" style="width:100%">
            </div> 
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Contra/Acc:" style="width:100%">
            </div> 
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Ingr/Desp:" style="width:100%">
            </div> 
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Actividad:" style="width:100%">
            </div> 
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Fecha:" style="width:100%">
            </div> 
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Ingresar Usuario');
            $('#fm').form('clear');
            url = 'controlador/usuario.php?op=insert';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
                $('#fm').form('load',row);
                url = 'controlador/usuario.php?op=update';
            }
        }
        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');      
                        $('#dg').datagrid('reload');   
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','¿Estás seguro de Eliminar el item seleccionado?',function(r){
                    if (r){
                        $.post('controlador/usuario.php?op=delete',{  login:row.login},function(result){
                            console.log(result);
                            if (result.status == 1 ){
                                $.messager.show({    
                                    title: 'ELIMINADO',
                                    msg: result.msg
                                });

                                $('#dg').datagrid('reload');    
                            } else {
                                $.messager.show({    
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>    
