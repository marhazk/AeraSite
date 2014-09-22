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
/*    */ public final class GMForbidRole extends Protocol
/*    */ {
/*    */   public byte fbd_type;
/*    */   public int gmroleid;
/*    */   public int localsid;
/*    */   public int dstroleid;
/*    */   public int forbid_time;
/*    */   public Octets reason;
/*    */ 
/*    */   public GMForbidRole()
/*    */   {
/* 19 */     this.reason = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 24 */     os.marshal(this.fbd_type);
/* 25 */     os.marshal(this.gmroleid);
/* 26 */     os.marshal(this.localsid);
/* 27 */     os.marshal(this.dstroleid);
/* 28 */     os.marshal(this.forbid_time);
/* 29 */     os.marshal(this.reason);
/* 30 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 35 */     this.fbd_type = os.unmarshal_byte();
/* 36 */     this.gmroleid = os.unmarshal_int();
/* 37 */     this.localsid = os.unmarshal_int();
/* 38 */     this.dstroleid = os.unmarshal_int();
/* 39 */     this.forbid_time = os.unmarshal_int();
/* 40 */     os.unmarshal(this.reason);
/* 41 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 48 */       GMForbidRole o = (GMForbidRole)super.clone();
/* 49 */       o.reason = ((Octets)this.reason.clone());
/* 50 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 53 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMForbidRole
 * JD-Core Version:    0.6.2
 */