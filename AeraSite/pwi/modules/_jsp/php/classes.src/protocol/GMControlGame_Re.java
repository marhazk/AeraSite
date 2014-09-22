/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class GMControlGame_Re extends Protocol
/*    */ {
/*    */   public int xid;
/*    */   public int retcode;
/*    */   public Rpc.Data.DataVector resvector;
/*    */ 
/*    */   public GMControlGame_Re()
/*    */   {
/* 17 */     this.resvector = new Rpc.Data.DataVector(new GMControlGameRes());
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.xid);
/* 23 */     os.marshal(this.retcode);
/* 24 */     os.marshal(this.resvector);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     this.xid = os.unmarshal_int();
/* 31 */     this.retcode = os.unmarshal_int();
/* 32 */     os.unmarshal(this.resvector);
/* 33 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 40 */       GMControlGame_Re o = (GMControlGame_Re)super.clone();
/* 41 */       o.resvector = ((Rpc.Data.DataVector)this.resvector.clone());
/* 42 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 45 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session) throws ProtocolException
/*    */   {
/* 50 */     DeliveryDB.GMControlGame_Re(this);
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMControlGame_Re
 * JD-Core Version:    0.6.2
 */