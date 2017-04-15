(function(){
	
	var url = "./server.php/"
	var operationBindings = [ {
		operationType : "fetch",
		dataProtocol : "postMessage",
		requestProperties : {
			httpMethod : "POST"
		}
	}, {
		operationType : "add",
		dataProtocol : "postMessage",
		requestProperties : {
			httpMethod : "POST"
		}
	}, {
		operationType : "remove",
		dataProtocol : "postMessage",
		requestProperties : {
			httpMethod : "POST"
		}
	}, {
		operationType : "update",
		dataProtocol : "postMessage",
		requestProperties : {
			httpMethod : "POST"
		}
	} ];
	
	function createRestDataSource(options) {
		options = options || {};
		
		options.dataFormat = "json";
		options.jsonPrefix = "";
		options.jsonSuffix = "";
		options.operationBindings = operationBindings;
		options.fetchDataURL = url;
		options.addDataURL = url;
		options.updateDataURL = url;
		options.removeDataURL = url;
		
		return isc.RestDataSource.create(options);
	}

	createRestDataSource({
	    ID:"CompanyDataSource",
	    fields:[ {
	    	name:"id",
	    	title:"Company ID",
	    	primaryKey:true,
	    	canEdit:false,
	    	hidden:true
	    }, {
	    	name:"name", 
	    	title:"Company Name"
	    } ],
	});
	
	createRestDataSource({
	    ID:"DepartmentDataSource",
	    fields:[ {
	    	name:"id",
	    	title:"ID",
	    	primaryKey:true,
	    	canEdit:false,
	    	hidden:true
	    }, {
	    	name:"name", 
	    	title:"Department Name"
	    }, {
	    	name:"companyId",
	    	title:"Company",
	    	foreignKey: "CompanyDataSource.id",
	    	valueField : "id",
	    	displayField : "name",
			optionDataSource : "CompanyDataSource",
			pickListWidth : 330,
			pickListFields : [ {
				name : "name"
			}, ],
	    } ],
	});

	createRestDataSource({
	    ID:"EmployeeDataSource",
	    fields:[ {
	    	name:"id",
	    	title:"ID",
	    	primaryKey:true,
	    	canEdit:false,
	    	hidden:true
	    }, {
	    	name:"firstName", 
	    	title:"First Name"
	    }, {
	    	name:"secondName", 
	    	title:"Second Name"
	    }, {
	    	name:"brithdate", 
	    	title:"Birthdate",
	    	type: "Date"
	    }, {
	    	name:"salary", 
	    	title:"Salary",
	    	type: "integer"
	    }, {
	    	name:"departmentId",
	    	title:"Department",
	    	foreignKey: "DepartmentDataSource.id",
	    	valueField : "id",
	    	displayField : "name",
			optionDataSource : "DepartmentDataSource",
			pickListWidth : 330,
			pickListFields : [ {
				name : "name"
			}, ],
	    } ],
	});	
	
	isc.ListGrid.create({
		autoDraw:false,
	    ID: "CompanyList",
	    width:"100%",
	    height:"100%",
	    alternateRecordStyles:true,
	    emptyCellValue: "--",
	    dataSource: "CompanyDataSource",
	    useAllDataSourceFields:true,
	    dataPageSize: 50,
	    autoFetchData:true,
	    canEdit:true
	});
	
	isc.ListGrid.create({
		autoDraw:false,
	    ID: "DepartmentList",
	    width:"100%",
	    height:"100%",
	    alternateRecordStyles:true,
	    emptyCellValue: "--",
	    dataSource: "DepartmentDataSource",
	    useAllDataSourceFields:true,
	    dataPageSize: 50,
	    autoFetchData:true,
	    canEdit:true
	});
	
	isc.ListGrid.create({
		autoDraw:false,
	    ID: "EmployeeList",
	    width:"100%",
	    height:"100%",
	    alternateRecordStyles:true,
	    emptyCellValue: "--",
	    dataSource: "EmployeeDataSource",
	    useAllDataSourceFields:true,
	    dataPageSize: 50,
	    autoFetchData:true,
	    canEdit:true
	});
	
	
	isc.VLayout.create({
	    width: "100%",
	    height: "100%",
	    members: [
	    	isc.ToolStrip.create({
	    	    width: "100%",
	    	    members: [
	    	    	isc.ToolStripButton.create({
	    	    		autoDraw:false,
	    	    	    title:"New Company",
	    	    	    click:"CompanyList.startEditingNew()"
	    	    	}),	    	    	
	    	    	isc.ToolStripButton.create({
	    	    		autoDraw:false,
	    	    		left: "100px",
	    	    	    title:"New Department",
	    	    	    click:"DepartmentList.startEditingNew()"
	    	    	}),	    	    	
	    	    	isc.ToolStripButton.create({
	    	    		autoDraw:false,
	    	    		left: "200px",
	    	    	    title:"New Employee",
	    	    	    click:"EmployeeList.startEditingNew()"
	    	    	})
	    	    ]
	    	}),
	    	isc.HLayout.create({
	    	    width: "100%",
	    	    height: "100%",
	    	    members: [
	    	    	isc.VLayout.create({
	    	    		autoDraw:false,
	    	    	    width: "20%",
	    	    	    height: "100%",
	    	    	    showResizeBar:true,
	    	    	    members: [
	    	    	    	"CompanyList",
	    	    	    ]
	    	    	}),
	    	    	isc.VLayout.create({
	    	    		autoDraw:false,
	    	    	    width: "100%",
	    	    	    height: "100%",
	    	    	    members: [
	    	    	    	isc.VLayout.create({
	    	    	    		autoDraw:false,
	    	    	    	    width: "100%",
	    	    	    	    height: "100%",
	    	    	    	    showResizeBar:true,
	    	    	    	    members: [
	    	    	    	    	"DepartmentList",
	    	    	    	    ]
	    	    	    	}),
	    	    	    	"EmployeeList"
	    	    	    ]
	    	    	}),
	    	    ]
	    	})
	    ]
	});
	
}());
