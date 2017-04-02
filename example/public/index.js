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
	    	title:"Department ID",
	    	primaryKey:true,
	    	canEdit:false
	    }, {
	    	name:"companyId",
	    	title:"Company ID",
	    	canEdit:false
	    }, {
	    	name:"name", 
	    	title:"Department Name"
	    } ],
	    dataFormat:"json",
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
	    top:"50px",
	    width:"100%",
	    height:"250px",
	    alternateRecordStyles:true,
	    emptyCellValue: "--",
	    dataSource: CompanyDataSource,
	    useAllDataSourceFields:true,
	    dataPageSize: 50,
	    autoFetchData:true,
	    canEdit:true
	});
	
	
	
}());
