/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class AnnounceServerAttribute extends Protocol
/*    */ {
/*    */   public int attr;
/*    */   public int freecreatime;
/*    */   public byte exp_rate;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 20 */     os.marshal(this.attr);
/* 21 */     os.marshal(this.freecreatime);
/* 22 */     os.marshal(this.exp_rate);
/* 23 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 28 */     this.attr = os.unmarshal_int();
/* 29 */     this.freecreatime = os.unmarshal_int();
/* 30 */     this.exp_rate = os.unmarshal_byte();
/* 31 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 38 */       return (AnnounceServerAttribute)super.clone();
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
 * Qualified Name:     protocol.AnnounceServerAttribute
 * JD-Core Version:    0.6.2
 */