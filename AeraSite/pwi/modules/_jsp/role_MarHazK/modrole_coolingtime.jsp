<%@page contentType="text/html; charset=GBK"%>
<%@page import="java.lang.*"%>
<%@page import="java.util.*"%>
<%@page import="java.text.*"%>
<%@page import="org.apache.commons.lang.StringEscapeUtils"%>
<%@page import="protocol.*"%>
<%@page import="com.goldhuman.auth.*"%>
<%@page import="org.apache.commons.logging.Log"%>
<%@page import="org.apache.commons.logging.LogFactory"%>
	//String cooltime = StringEscapeUtils.escapeHtml(role.status.coolingtime.getString());
	byte[] cooltimeByte = role.status.coolingtime.getBytes();
	byte[] cooltimeByte_test = new byte[10];
	String cooltime = null;
	int test = 0;
	//String _cooltime;
	//int _cooltime = 0;
	byte _cooltime = 0;
	while (true)
	{
		try
		{
			_cooltime = cooltimeByte[test];
			//_cooltime = Integer.parseInt(cooltimeByte[test]);
			//_cooltime = Integer.toOctalString(cooltimeByte[test]);
			//_cooltime = Integer.toHexString(cooltimeByte[test]);
			if (0 == _cooltime) break;
			if (null == cooltime) 
			{
				cooltime = _cooltime;
			}
			else
			{
				cooltime += " " + _cooltime;
			}
			
			//cooltimeByte_test[test] = Byte.valueOf(_cooltime);
			cooltimeByte_test[test] = _cooltime;
			test++;
		}
		catch (Exception e)
		{
			break;
		}
	}
<%
	
	Boolean bool = Boolean.valueOf("true");
    Character c = new Character('c');
    Byte b = Byte.valueOf("1a");
    Short s = Short.valueOf("2");
    Integer i = Integer.valueOf("13245");
    Long l = Long.valueOf("12341234");
    Float f = Float.valueOf("11234.1234");
    Double d = Double.valueOf("43213241234.123412341234");

    out.println(bool);
    out.println(c);
    out.println(b);
    out.println(s);
    out.println(i);
    out.println(l);
    out.println(f);
    out.println(d);
    
    //out.println("TEST2-in:" + new String(cooltimeByte, 0));
    //out.println("TEST2-out:" + new String(cooltimeByte_test, 0));

    //out.println("TEST2:"+ new String(ax, 0));
%></p>