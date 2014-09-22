/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class GMShutupRole_Re extends Protocol
/*    */ {
/*    */   public int retcode;
/*    */   public int dstroleid;
/*    */   public int forbid_time;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 20 */     os.marshal(this.retcode);
/* 21 */     os.marshal(this.dstroleid);
/* 22 */     os.marshal(this.forbid_time);
/* 23 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 28 */     this.retcode = os.unmarshal_int();
/* 29 */     this.dstroleid = os.unmarshal_int();
/* 30 */     this.forbid_time = os.unmarshal_int();
/* 31 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 38 */       return (GMShutupRole_Re)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 42 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMShutupRole_Re
 * JD-Core Version:    0.6.2
 */