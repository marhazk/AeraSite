/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class GMForbidRole_Re extends Protocol
/*    */ {
/*    */   public int retcode;
/*    */   public byte fbd_type;
/*    */   public int dstroleid;
/*    */   public int forbid_time;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.retcode);
/* 22 */     os.marshal(this.fbd_type);
/* 23 */     os.marshal(this.dstroleid);
/* 24 */     os.marshal(this.forbid_time);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     this.retcode = os.unmarshal_int();
/* 31 */     this.fbd_type = os.unmarshal_byte();
/* 32 */     this.dstroleid = os.unmarshal_int();
/* 33 */     this.forbid_time = os.unmarshal_int();
/* 34 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 41 */       return (GMForbidRole_Re)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 45 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session) throws ProtocolException
/*    */   {
/* 50 */     DeliveryDB.GMForbidRole_Re(this.retcode, this.fbd_type, this.dstroleid, this.forbid_time);
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMForbidRole_Re
 * JD-Core Version:    0.6.2
 */