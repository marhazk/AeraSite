/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class GMRestartServer extends Protocol
/*    */ {
/*    */   public int gmroleid;
/*    */   public int localsid;
/*    */   public int gsid;
/*    */   public int restart_time;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.gmroleid);
/* 22 */     os.marshal(this.localsid);
/* 23 */     os.marshal(this.gsid);
/* 24 */     os.marshal(this.restart_time);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     this.gmroleid = os.unmarshal_int();
/* 31 */     this.localsid = os.unmarshal_int();
/* 32 */     this.gsid = os.unmarshal_int();
/* 33 */     this.restart_time = os.unmarshal_int();
/* 34 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 41 */       return (GMRestartServer)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 45 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMRestartServer
 * JD-Core Version:    0.6.2
 */