var url = "./server.php/"

isc.RestDataSource.create({
    ID:"testDS",
    
    fields:[
        {name:"countryCode", title:"Code", primaryKey:true, canEdit:false},
        {name:"countryName", title:"Country"},
        {name:"capital", title:"Capital"}
    ],
    
    dataFormat:"json",
    
    operationBindings : [ {
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
	} ],
    
    fetchDataURL:url,
    addDataURL:url,
    updateDataURL:url,
    removeDataURL:url
    
        
});

isc.ListGrid.create({
    ID: "testList",
    width:"100%",
    height:"100%",
    alternateRecordStyles:true,
    emptyCellValue: "--",
    dataSource: testDS,
    useAllDataSourceFields:true,
    dataPageSize: 50,
    autoFetchData:true
});