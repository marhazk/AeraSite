/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class IntOctets extends Rpc.Data
/*    */ {
/*    */   public int m_int;
/*    */   public Octets m_octets;
/*    */ 
/*    */   public IntOctets()
/*    */   {
/* 15 */     this.m_octets = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 20 */     os.marshal(this.m_int);
/* 21 */     os.marshal(this.m_octets);
/* 22 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 27 */     this.m_int = os.unmarshal_int();
/* 28 */     os.unmarshal(this.m_octets);
/* 29 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 36 */       IntOctets o = (IntOctets)super.clone();
/* 37 */       o.m_octets = ((Octets)this.m_octets.clone());
/* 38 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 41 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.IntOctets
 * JD-Core Version:    0.6.2
 */