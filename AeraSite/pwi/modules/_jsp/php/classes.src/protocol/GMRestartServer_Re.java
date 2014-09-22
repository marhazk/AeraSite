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
/*    */ public final class GMRestartServer_Re extends Protocol
/*    */ {
/*    */   public int retcode;
/*    */   public int gmroleid;
/*    */   public int localsid;
/*    */   public int gsid;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.retcode);
/* 22 */     os.marshal(this.gmroleid);
/* 23 */     os.marshal(this.localsid);
/* 24 */     os.marshal(this.gsid);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     this.retcode = os.unmarshal_int();
/* 31 */     this.gmroleid = os.unmarshal_int();
/* 32 */     this.localsid = os.unmarshal_int();
/* 33 */     this.gsid = os.unmarshal_int();
/* 34 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 41 */       return (GMRestartServer_Re)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 45 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session) throws ProtocolException
/*    */   {
/* 50 */     System.out.println("GMRestartServer_Re, retcode=" + this.retcode + ",gmroleid=" + this.gmroleid);
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMRestartServer_Re
 * JD-Core Version:    0.6.2
 */