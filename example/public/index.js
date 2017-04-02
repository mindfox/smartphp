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
	    ID:"CompanyDS",
	    
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
	    title:"Edit New",
	    click:"CompanyList.startEditingNew()"
	});
	
	isc.ListGrid.create({
	    ID: "CompanyList",
	    top:"50px",
	    width:"100%",
	    height:"250px",
	    alternateRecordStyles:true,
	    emptyCellValue: "--",
	    dataSource: CompanyDS,
	    useAllDataSourceFields:true,
	    dataPageSize: 50,
	    autoFetchData:true,
	    canEdit:true
	});
	
	
	
}());
