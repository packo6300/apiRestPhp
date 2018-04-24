<?php

/**
 * Este archivo esta destinado a crear todas las constantes con los querys definidos para el modulo de clientes
 * @author Javier Delgado <packo6300@gmail.com>
 * @version 1.0
 */

define("GET_CLIENTS", "SELECT DISTINCT T0.accountnum 'ClaveCliente',T1.NAME 'Nombre' FROM custtable T0 INNER JOIN dirpartytable T1 ON T0.party = T1.recid LEFT JOIN logisticslocation T2 ON T1.primaryaddresslocation = T2.recid AND T2.ispostaladdress = '1' LEFT JOIN logisticspostaladdress T3 ON T2.recid = T3.location AND Dateadd(hour, -7, T3.validfrom) < Getdate() AND T3.validto > Getdate() where DATAAREAID= :company ");
define("GET_CLIENTS_BY_CLAVE", "SELECT T0.ACCOUNTNUM 'ClaveCliente', T1.NAME 'Nombre', ISNULL(T3.ADDRESS,'Sin Dirección') 'Direccion', T3.RECID 'RecIdDireccion', T0.INVENTSITEID 'Sitio', T0.INVENTLOCATION 'Almacen', CASE WHEN T0.DLVTERM='' THEN 'CONTADO' ELSE T0.DLVTERM END 'CondEntrega', T0.PAYMMODE 'MetodoPago', CASE T0.BLOCKED WHEN '0' THEN 'No' WHEN '1' THEN 'Factura' WHEN '2' THEN 'Todo' END AS 'Bloqueo', T0.BANKACCOUNT 'CuentaBanco', T0.DLVMODE 'ModoEntrega' FROM CUSTTABLE T0 INNER JOIN DIRPARTYTABLE T1 ON T0.PARTY=T1.RECID LEFT JOIN LOGISTICSLOCATION T2 ON T1.PRIMARYADDRESSLOCATION=T2.RECID AND T2.ISPOSTALADDRESS='1' LEFT JOIN LOGISTICSPOSTALADDRESS T3 ON T2.RECID=T3.LOCATION AND DATEADD(HOUR,-7,T3.VALIDFROM)<GETDATE() AND T3.VALIDTO>GETDATE() WHERE T0.ACCOUNTNUM = :clave");
