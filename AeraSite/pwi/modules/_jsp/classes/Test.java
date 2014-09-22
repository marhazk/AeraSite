/*    */ import com.goldhuman.Common.Conf;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.Common.ThreadPool;
/*    */ import com.goldhuman.IO.PollIO;
/*    */ import java.io.File;
/*    */ import java.io.FileOutputStream;
/*    */ import java.io.PrintStream;
/*    */ import javax.xml.transform.Transformer;
/*    */ import javax.xml.transform.TransformerFactory;
/*    */ import javax.xml.transform.dom.DOMSource;
/*    */ import javax.xml.transform.stream.StreamResult;
/*    */ import org.apache.commons.logging.Log;
/*    */ import org.apache.commons.logging.LogFactory;
/*    */ import org.w3c.dom.Document;
/*    */ import protocol.GameDB;
/*    */ import protocol.XmlRole;
/*    */ import protocol.XmlRole.Role;
/*    */ 
/*    */ public class Test extends Thread
/*    */ {
/* 23 */   private static final Log log = LogFactory.getLog(Test.class);
/*    */ 
/*    */   public static void main(String[] args)
/*    */   {
/*    */     try
/*    */     {
/* 29 */       if (args.length < 2)
/*    */       {
/* 31 */         System.out.println("error arguments. usage: java Test [get|put] roleid");
/* 32 */         return;
/*    */       }
/*    */ 
/* 35 */       Octets.setDefaultCharset("UTF-16LE");
/* 36 */       Conf.GetInstance(Test.class.getResource("/iweb.conf"), null);
/* 37 */       ThreadPool.AddTask(PollIO.GetTask());
/*    */ 
/* 39 */       if (args[0].equals("get"))
/*    */       {
/* 41 */         int roleid = Integer.parseInt(args[1]);
/* 42 */         XmlRole.Role role = XmlRole.getRoleFromDB(roleid);
/* 43 */         if (null != role)
/*    */         {
/* 45 */           XmlRole.toXMLFile(role, new File(Integer.toString(roleid) + ".xml"));
/* 46 */           System.out.println(new String(XmlRole.toXMLByteArray(role), "UTF-8"));
/*    */         }
/*    */         else
/*    */         {
/* 50 */           System.out.println("no this role in remote gamedb.");
/*    */         }
/*    */       }
/* 53 */       else if (args[0].equals("put"))
/*    */       {
/* 55 */         int roleid = Integer.parseInt(args[1]);
/* 56 */         XmlRole.Role role = XmlRole.fromXML(new File(Integer.toString(roleid) + ".xml"));
/*    */ 
/* 58 */         if (null != role)
/*    */         {
/* 60 */           Document doc = XmlRole.toXML(role);
/* 61 */           Transformer trans = TransformerFactory.newInstance().newTransformer();
/* 62 */           trans.transform(new DOMSource(doc), new StreamResult(new FileOutputStream(new File(Integer.toString(roleid) + "-2.xml"))));
/*    */         }
/*    */ 
/* 66 */         if (null != role)
/*    */         {
/* 69 */           boolean b = XmlRole.putRoleToDB(roleid, role);
/* 70 */           System.out.println("putRoleToDB ret=" + b);
/*    */         }
/*    */         else
/*    */         {
/* 74 */           System.out.println("no this role in locolhost(roleid.xml).");
/*    */         }
/*    */       }
/* 77 */       else if (args[0].equals("move"))
/*    */       {
/* 79 */         int roleid = Integer.parseInt(args[1]);
/* 80 */         int newuserid = Integer.parseInt(args[2]);
/*    */         try {
/* 82 */           boolean b = GameDB.moveRole(roleid, newuserid);
/* 83 */           System.out.println("moveRole finish. ret=" + b);
/*    */         } catch (Exception e) {
/* 85 */           System.out.println("moveRole finish. ret=false" + e.toString());
/*    */         }
/*    */       }
/* 88 */       else if (args[0].equals("del"))
/*    */       {
/* 90 */         int roleid = Integer.parseInt(args[1]);
/* 91 */         boolean b = GameDB.deleteRolePermanent(roleid);
/* 92 */         System.out.println("delRole finish. ret=" + b);
/*    */       }
/*    */       else
/*    */       {
/* 96 */         System.out.println("error arguments. usage: java Test [get|put] roleid");
/*    */       }
/*    */ 
/*    */     }
/*    */     catch (Exception e)
/*    */     {
/* 103 */       e.printStackTrace();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     Test
 * JD-Core Version:    0.6.2
 */