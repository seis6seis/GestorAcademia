//

if (!window.Sigma){
	window.Sigma={};
}
Sigma.Msg=Sigma.Msg || {};
SigmaMsg=Sigma.Msg;

Sigma.Msg.Grid = Sigma.Msg.Grid || {};

Sigma.Msg.Grid.en={
	LOCAL	: "SP",
	ENCODING		: "UTF-8",
	NO_DATA : "No Datos",


	GOTOPAGE_BUTTON_TEXT: 'Ir a',

	FILTERCLEAR_TEXT: "Eliminar Filtros",
	SORTASC_TEXT	: "Ascendente",
	SORTDESC_TEXT	: "Descendente",
	SORTDEFAULT_TEXT: "Original",

	ERR_PAGENUM		: "Page number must be an integer between 1 to #{1}.",

	EXPORT_CONFIRM	: "This operation will affect all records of the whole table.\n\n( Press \"Cancel\" to limit scope to current page.)",
	OVER_MAXEXPORT	: "Number of record exceeds #{1}, the maximum allowed.",

	PAGE_STATE	: "#{1} - #{2} displayed,  #{3}pages #{4} records totally.",
	PAGE_STATE_FULL	: "Numero de registros: #{4}  ",

	SHADOWROW_FAILED: "Relevant info not available",
	NEARPAGE_TITLE	: "",
	WAITING_MSG : 'Espere por favor...',

	NO_RECORD_UPDATE: "Nothing Modified",
	UPDATE_CONFIRM	: "Are you sure to save them?",
	NO_MODIFIED: "Nothing Modified",

	
	PAGE_BEFORE : 'Pagina',
	PAGE_AFTER : '',

	PAGESIZE_BEFORE :   '',
	PAGESIZE_AFTER :   'Por Pagina',

	RECORD_UNIT : '',
	
	CHECK_ALL : 'Marcar Todo',

	COLUMNS_HEADER : 'Columnas',

	DIAG_TITLE_FILTER : 'Opciones de Filtros',
	DIAG_NO_FILTER : 'Sin filtros',
	TEXT_ADD_FILTER	: "Anadir",
	TEXT_CLEAR_FILTER	: "Borrar todos",
	TEXT_OK	: "OK",
	TEXT_DEL : "Borrar",
	TEXT_CANCEL	: "Cancelar",
	TEXT_CLOSE	: "Cerrar",
	TEXT_UP : "Arriba",
	TEXT_DOWN : "Abajo",

	NOT_SAVE : "¿Desea grabar los cambios? \n Haz Click \"Cancelar\" para descartar.",

	DIAG_TITLE_CHART  : 'Chart',

	CHANGE_SKIN : "Skins",

	STYLE_NAME_DEFAULT : "Classic",
	STYLE_NAME_CHINA : "Pink",
	STYLE_NAME_VISTA : "Vista",
	STYLE_NAME_MAC : "Mac",

	MENU_FREEZE_COL : "Lock Columns",
	MENU_SHOW_COL : "Hide Columns",
	MENU_GROUP_COL : "Group Span",

	TOOL_RELOAD : "Refrecar" ,
	TOOL_ADD : "Anadir" ,
	TOOL_DEL : "Borrar" ,
	TOOL_SAVE : "Grabar" ,

	TOOL_PRINT : "Imprimir" ,
	TOOL_XLS : "Exportar a xls" ,
	TOOL_PDF : "Exportar a pdf" ,
	TOOL_CSV : "Exportar a csv" ,
	TOOL_XML : "Exportar a xml",
	TOOL_FILTER : "Filtro" ,
	TOOL_CHART : "Grafico" 

};

Sigma.Msg.Grid['default']=Sigma.Msg.Grid.en;


if (!Sigma.Msg.Validator){
	Sigma.Msg.Validator={ };
}

Sigma.Msg.Validator.en={

		'required'	: '{0#This field} is required.',
		'date'		: '{0#This field} must be in proper format ({1#YYYY-MM-DD}).',
		'time'		: '{0#This field} must be in proper format ({1#HH:mm}).',
		'datetime'	: '{0#This field} must be in proper format ({1#YYYY-MM-DD HH:mm}).',
		'email'		: '{0#This field} must be in proper email format.',
		'telephone'	: '{0#This field} must be in proper phone no format.',
		'number'	: '{0} must be a number.',
		'integer'	: '{0} must be an integer.',
		'float'		: '{0} must be integer or decimal.',
		'money'		: '{0} must be integer or decimal with 2 fraction digits.',
		'range'		: '{0} must be between {1} and {2}.',
		'equals'	: '{0} must be same as {1}.',
		'lessthen'	: '{0} must be less than {1}.',
		'idcard'	: '{0} must be in proper ID format',

		'enchar'	: 'Letters, digits or underscore allowed only for {0}',
		'cnchar'	: '{0} must be Chinese charactors',
		'minlength'	: '{0} must contain more than {1} characters.',
		'maxlength'	: '{0} must contain less than {1} characters.'

}

Sigma.Msg.Validator['default'] = Sigma.Msg.Validator.en;

//