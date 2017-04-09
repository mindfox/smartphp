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

	isc.RestDataSource.create({
	    ID:"CompanyDataSource",
	    fields:[ {
	    	name:"id",
	    	title:"Company ID",
	    	primaryKey:true,
	    	canEdit:false
	    }, {
	    	name:"name", 
	    	title:"Company Name"
	    } ],
	    dataFormat:"json",
	    jsonPrefix:"",
	    jsonSuffix:"",
	    operationBindings : operationBindings,
	    fetchDataURL:url,
	    addDataURL:url,
	    updateDataURL:url,
	    removeDataURL:url
	});

	isc.RestDataSource.create({
	    ID:"DepartmentDataSource",
	    fields:[ {
	    	name:"id",
	    	title:"ID",
	    	primaryKey:true,
	    	canEdit:false
	    }, {
	    	name:"name", 
	    	title:"Name"
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
	    dataFormat:"json",
	    jsonPrefix:"",
	    jsonSuffix:"",
	    operationBindings : operationBindings,
	    fetchDataURL:url,
	    addDataURL:url,
	    updateDataURL:url,
	    removeDataURL:url
	});

	isc.RestDataSource.create({
	    ID:"EmployeeDataSource",
	    fields:[ {
	    	name:"id",
	    	title:"ID",
	    	primaryKey:true,
	    	canEdit:false
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
	    dataFormat:"json",
	    jsonPrefix:"",
	    jsonSuffix:"",
	    operationBindings : operationBindings,
	    fetchDataURL:url,
	    addDataURL:url,
	    updateDataURL:url,
	    removeDataURL:url
	});

	isc.IButton.create({
	    title:"New Company",
	    click:"CompanyList.startEditingNew()"
	});
	
	isc.IButton.create({
		left: "100px",
	    title:"New Department",
	    click:"DepartmentList.startEditingNew()"
	});
	
	isc.IButton.create({
		left: "200px",
	    title:"New Employee",
	    click:"EmployeeList.startEditingNew()"
	});
	
	isc.ListGrid.create({
	    ID: "CompanyList",
	    top:"30px",
	    width:"100%",
	    height:"100px",
	    alternateRecordStyles:true,
	    emptyCellValue: "--",
	    dataSource: "CompanyDataSource",
	    useAllDataSourceFields:true,
	    dataPageSize: 50,
	    autoFetchData:true,
	    canEdit:true
	});
	
	isc.ListGrid.create({
	    ID: "DepartmentList",
	    top:"130px",
	    width:"100%",
	    height:"100px",
	    alternateRecordStyles:true,
	    emptyCellValue: "--",
	    dataSource: "DepartmentDataSource",
	    useAllDataSourceFields:true,
	    dataPageSize: 50,
	    autoFetchData:true,
	    canEdit:true
	});
	
	isc.ListGrid.create({
	    ID: "EmployeeList",
	    top:"230px",
	    width:"100%",
	    height:"100px",
	    alternateRecordStyles:true,
	    emptyCellValue: "--",
	    dataSource: "EmployeeDataSource",
	    useAllDataSourceFields:true,
	    dataPageSize: 50,
	    autoFetchData:true,
	    canEdit:true
	});
	
	
	
}());
