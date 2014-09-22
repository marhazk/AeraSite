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
/*    */ public final class SetMaxOnlineNum_Re extends Protocol
/*    */ {
/*    */   public int retcode;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 18 */     os.marshal(this.retcode);
/* 19 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 24 */     this.retcode = os.unmarshal_int();
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 32 */       return (SetMaxOnlineNum_Re)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 36 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session) throws ProtocolException
/*    */   {
/* 41 */     System.out.println("SetMaxOnlineNum_Re, retcode=" + this.retcode);
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.SetMaxOnlineNum_Re
 * JD-Core Version:    0.6.2
 */