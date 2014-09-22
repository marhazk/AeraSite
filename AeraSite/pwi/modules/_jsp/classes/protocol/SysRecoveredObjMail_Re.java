/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ import java.io.PrintStream;
/*    */ 
/*    */ public final class SysRecoveredObjMail_Re extends Protocol
/*    */ {
/*    */   public short retcode;
/*    */   public int tid;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 19 */     os.marshal(this.retcode);
/* 20 */     os.marshal(this.tid);
/* 21 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 26 */     this.retcode = os.unmarshal_short();
/* 27 */     this.tid = os.unmarshal_int();
/* 28 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 35 */       return (SysRecoveredObjMail_Re)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 39 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session) throws ProtocolException
/*    */   {
/* 44 */     System.out.println("SysRecoveredObjMail_Re recv");
/* 45 */     DeliveryDB.SysRecoveredObjMail_Re(this);
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.SysRecoveredObjMail_Re
 * JD-Core Version:    0.6.2
 */