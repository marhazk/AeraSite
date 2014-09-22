/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class GMShutupRole extends Protocol
/*    */ {
/*    */   public int gmroleid;
/*    */   public int localsid;
/*    */   public int dstroleid;
/*    */   public int forbid_time;
/*    */   public Octets reason;
/*    */ 
/*    */   public GMShutupRole()
/*    */   {
/* 18 */     this.reason = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 23 */     os.marshal(this.gmroleid);
/* 24 */     os.marshal(this.localsid);
/* 25 */     os.marshal(this.dstroleid);
/* 26 */     os.marshal(this.forbid_time);
/* 27 */     os.marshal(this.reason);
/* 28 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 33 */     this.gmroleid = os.unmarshal_int();
/* 34 */     this.localsid = os.unmarshal_int();
/* 35 */     this.dstroleid = os.unmarshal_int();
/* 36 */     this.forbid_time = os.unmarshal_int();
/* 37 */     os.unmarshal(this.reason);
/* 38 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 45 */       GMShutupRole o = (GMShutupRole)super.clone();
/* 46 */       o.reason = ((Octets)this.reason.clone());
/* 47 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 50 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMShutupRole
 * JD-Core Version:    0.6.2
 */