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
	    	name:"companyId",
	    	title:"Company",
	    	foreignKey: "CompanyDataSource.id",
	    	valueField : "id",
	    	displayField : "name",
			optionDataSource : CompanyDataSource,
			pickListWidth : 330,
			pickListFields : [ {
				name : "name"
			}, ],
	    }, {
	    	name:"name", 
	    	title:"Name"
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

	isc.IButton.create({
	    title:"New Company",
	    click:"CompanyList.startEditingNew()"
	});
	
	isc.ListGrid.create({
	    ID: "CompanyList",
	    top:"30px",
	    width:"100%",
	    height:"100px",
	    alternateRecordStyles:true,
	    emptyCellValue: "--",
	    dataSource: CompanyDataSource,
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
	    dataSource: DepartmentDataSource,
	    useAllDataSourceFields:true,
	    dataPageSize: 50,
	    autoFetchData:true,
	    canEdit:true
	});
	
	
	
}());
